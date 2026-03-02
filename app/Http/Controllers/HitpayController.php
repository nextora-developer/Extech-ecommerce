<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderPlacedMail;
use App\Mail\AdminOrderNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HitpayController extends Controller
{

    public function createPayment(Order $order)
    {
        $amount   = number_format($order->total, 2, '.', '');
        $currency = config('services.hitpay.currency', 'MYR');

        $payload = [
            'amount'           => $amount,
            'currency'         => $currency,
            'reference_number' => $order->order_no,
            'name'             => $order->customer_name ?? 'Customer',
            'email'            => $order->customer_email ?? null,
            'phone'            => $order->customer_phone ?? null,
            'purpose'          => 'Order ' . $order->order_no,
            'redirect_url'     => route('hitpay.return'),
            'webhook'          => route('hitpay.webhook'),
        ];

        $baseUrl = rtrim(config('services.hitpay.url'), '/');

        $response = Http::asForm()
            ->withHeaders([
                'X-BUSINESS-API-KEY' => config('services.hitpay.api_key'),
                'Accept'             => 'application/json',
                'X-Requested-With'   => 'XMLHttpRequest',
            ])
            ->post($baseUrl . '/v1/payment-requests', $payload);

        if (! $response->successful()) {
            Log::error('HitPay create payment failed', [
                'order_no' => $order->order_no,
                'status'   => $response->status(),
                'body'     => $response->body(),
            ]);

            return redirect()
                ->route('account.orders.show', $order)
                ->with('error', 'Unable to create HitPay payment. Please try again.');
        }

        $data        = $response->json();
        $checkoutUrl = $data['payment_url'] ?? $data['url'] ?? null;

        if (! $checkoutUrl) {
            Log::error('HitPay response missing checkout URL', $data);

            return redirect()
                ->route('account.orders.show', $order)
                ->with('error', 'HitPay response invalid. Please contact support.');
        }

        session(['checkout_order_id' => $order->id]);

        $order->update([
            'payment_reference' => $data['id'] ?? null,
        ]);

        return redirect()->away($checkoutUrl);
    }



    public function handleReturn(Request $request)
    {
        Log::info('HITPAY RETURN HIT', [
            'ip'    => $request->ip(),
            'query' => $request->query(),
        ]);

        $reference = $request->query('reference') ?? $request->query('reference_number');

        $order = null;

        // ✅ 先拿 session
        $sessionOrderId = session('checkout_order_id');
        if ($sessionOrderId) {
            $order = Order::find($sessionOrderId);
        }

        // ✅ 有 reference 就做校验 / fallback（避免 session 拿错单）
        if ($reference) {
            if (! $order || $order->order_no !== $reference) {
                $order = Order::where('order_no', $reference)->first();
            }
        }

        if (! $order) {
            return redirect()->route('account.orders.index')
                ->with('error', 'Order not found.');
        }

        $localStatus = strtolower((string) $order->status);

        $returnStatusRaw = $request->query('status')
            ?? $request->query('payment_status')
            ?? '';

        $returnStatus = strtolower(trim((string) $returnStatusRaw));

        Log::info('HITPAY RETURN status snapshot', [
            'order_no' => $order->order_no,
            'local'    => $localStatus,
            'return'   => $returnStatusRaw,
        ]);

        // ✅ 已 paid -> success
        if ($localStatus === 'paid') {
            // ✅ 用完清掉，避免下次拿错单
            session()->forget('checkout_order_id');

            return redirect()->route('checkout.success', $order);
        }

        // ✅ 只有 pending/processing 才允许 return 判失败
        $failSignals = ['failed', 'cancelled', 'canceled', 'expired', 'void'];

        if (
            in_array($localStatus, ['pending', 'processing'], true)
            && $returnStatus !== ''
            && in_array($returnStatus, $failSignals, true)
        ) {
            $order->update([
                'status'         => 'failed',
                'payment_status' => $returnStatusRaw ?: 'failed',
                'gateway'        => $order->gateway ?? 'hitpay',
            ]);

            // ✅ 用完清掉
            session()->forget('checkout_order_id');

            return redirect()->route('account.orders.show', $order)
                ->with('error', 'Payment not completed. Order marked as failed.');
        }

        // ✅ 其他情况：不要改状态，让 webhook 来更新
        // 这里建议跳去 processing 页面（轮询），不然用户要手动 refresh
        return redirect()->route('account.orders.show', $order)
            ->with('info', 'Payment is processing. Please refresh in a moment.');
    }



    /**
     * HitPay Webhook 接收端
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        Log::info('HitPay webhook received', [
            'payload'    => $payload,
            'headers'    => $request->headers->all(),
            'user_agent' => $request->userAgent(),
        ]);

        // 🔎 区分几种来源
        $userAgent = $request->userAgent() ?? '';
        $headers   = array_change_key_case($request->headers->all(), CASE_LOWER);

        // v2 JSON Event（通常有 HitPay-Event-Object / HitPay-Event-Type 这些 header）
        $isJsonEventV2 = isset($headers['hitpay-event-object']);

        /**
         * 1️⃣ HitPay JSON Event v2：目前不用来更新订单，只记 log + 回 200
         */
        if ($isJsonEventV2) {
            Log::info('HitPay JSON event v2 received (ignored for status update)', [
                'event_type'   => $headers['hitpay-event-type'][0]   ?? null,
                'event_object' => $headers['hitpay-event-object'][0] ?? null,
            ]);

            return response('OK (event v2 ignored)', 200);
        }

        /**
         * 2️⃣ 旧版 x-www-form-urlencoded webhook（带 hmac，用来更新订单 status）
         */

        // local 环境可以跳过 HMAC，production 一定要验
        $skipHmac = app()->environment('local');

        if ($skipHmac) {
            Log::info('HitPay webhook: skip HMAC verification (debug mode)', [
                'env'        => app()->environment(),
                'user_agent' => $userAgent,
            ]);
        } else {
            // ✅ 正式环境：严格 HMAC 验证

            $receivedHmac = $payload['hmac'] ?? null;

            if (! $receivedHmac) {
                Log::warning('HitPay webhook missing hmac', ['payload' => $payload]);
                return response('Missing hmac', 400);
            }

            // 计算签名前必须排除 hmac 本身
            unset($payload['hmac']);

            // 使用 config/services.php 里的 HITPAY_SALT
            $secret = config('services.hitpay.salt');

            if (! $secret) {
                Log::error('HitPay webhook: missing salt configuration (services.hitpay.salt)');
                return response('Server configuration error', 500);
            }

            // 🔐 HitPay 官方算法：
            // 1) 对每个 key，拼成 "key" . "value"
            // 2) 按 key 排序
            // 3) 全部串起来，然后用 HMAC-SHA256
            $hmacSource = [];

            foreach ($payload as $key => $val) {
                if (is_bool($val)) {
                    $val = $val ? '1' : '0';
                } elseif ($val === null) {
                    $val = '';
                }

                $hmacSource[$key] = $key . (string) $val;
            }

            ksort($hmacSource);

            $signingString = implode('', array_values($hmacSource));

            $calculated = hash_hmac('sha256', $signingString, $secret);

            if (! hash_equals($calculated, $receivedHmac)) {
                Log::warning('HitPay webhook invalid signature', [
                    'payload'    => $payload,
                    'signing'    => $signingString,
                    'calculated' => $calculated,
                    'received'   => $receivedHmac,
                ]);

                return response('Invalid signature', 400);
            }

            Log::info('HitPay webhook signature verified');
        }

        /**
         * 3️⃣ 用 reference_number 找订单
         *    你 createPayment 那边已经把 order_no 放在 reference_number
         */
        $reference = $payload['reference_number'] ?? null;

        if (! $reference) {
            Log::warning('HitPay webhook missing reference_number', ['payload' => $payload]);
            return response('Missing reference_number', 400);
        }

        /** @var \App\Models\Order|null $order */
        $order = Order::where('order_no', $reference)->first();

        if (! $order) {
            Log::warning('HitPay webhook order not found', ['reference' => $reference]);
            return response('Order not found', 404);
        }

        $oldStatus = $order->status;

        $statusRaw = $payload['status'] ?? '';
        $status    = strtolower($statusRaw);

        Log::info('HitPay webhook order status', [
            'order_no'      => $order->order_no,
            'hitpay_status' => $statusRaw,
            'old_status'    => $oldStatus,
        ]);

        // /**
        //  * 4️⃣ 根据 HitPay status 更新订单
        //  */

        // // ✅ 付款成功
        // if (in_array($status, ['succeeded', 'completed', 'success', 'paid'], true)) {

        //     $alreadyPaid = $order->status === 'paid';

        //     $order->update([
        //         'status'         => 'paid',
        //         'payment_status' => $statusRaw ?: 'completed',
        //         'payment_reference' => $payload['payment_id'] ?? $order->payment_reference,
        //         'gateway'           => 'hitpay',
        //     ]);

        //     Log::info('HitPay webhook set order to paid', [
        //         'order_no'     => $order->order_no,
        //         'already_paid' => $alreadyPaid,
        //     ]);

        //     // 只在第一次从非 paid 变成 paid 的时候发 email
        //     if (! $alreadyPaid) {
        //         try {
        //             if ($order->customer_email) {
        //                 Mail::to($order->customer_email)
        //                     ->send(new OrderPlacedMail($order));
        //             }

        //             if (config('mail.admin_address')) {
        //                 Mail::to(config('mail.admin_address'))
        //                     ->send(new AdminOrderNotificationMail($order));
        //             }

        //             Log::info('HitPay webhook emails sent for order ' . $order->order_no);
        //         } catch (\Throwable $e) {
        //             Log::error('HitPay webhook email failed for ' . $order->order_no . ' : ' . $e->getMessage());
        //         }
        //     }
        // }
        // // ❌ 付款失败 / 被取消
        // elseif (in_array($status, ['failed', 'cancelled', 'canceled', 'void'], true)) {
        //     $order->update([
        //         'status'         => 'failed',
        //         'payment_status' => $statusRaw ?: 'failed',
        //         'gateway'        => $order->gateway ?? 'hitpay',
        //     ]);

        //     Log::info('HitPay webhook marked payment as FAILED', [
        //         'order_no'      => $order->order_no,
        //         'hitpay_status' => $statusRaw,
        //     ]);
        // }
        // // 其他状态先只记 log
        // else {
        //     Log::info('HitPay webhook unhandled status', [
        //         'order_no' => $order->order_no,
        //         'status'   => $statusRaw,
        //     ]);
        // }

        // return response('OK', 200);

        /**
         * 4️⃣ 根据 HitPay status 更新订单
         */

        $isSuccess = in_array($status, ['succeeded', 'completed', 'success', 'paid'], true);
        $isFail    = in_array($status, ['failed', 'cancelled', 'canceled', 'void', 'expired'], true);

        // ✅ A) 成功：永远允许覆盖（包括 failed → paid）
        if ($isSuccess) {

            $alreadyPaid = $order->status === 'paid';

            $order->update([
                'status'            => 'paid',
                'payment_status'    => $statusRaw ?: 'completed',
                'payment_reference' => $payload['payment_id'] ?? $order->payment_reference,
                'gateway'           => 'hitpay',
                // 建议：加 paid_at（如果你有这个字段）
                // 'paid_at'           => $order->paid_at ?? now(),
            ]);

            Log::info('HitPay webhook set order to paid (override allowed)', [
                'order_no'     => $order->order_no,
                'old_status'   => $oldStatus,
                'already_paid' => $alreadyPaid,
            ]);

            // 只在第一次从非 paid → paid 发 email
            if (! $alreadyPaid) {
                try {
                    if ($order->customer_email) {
                        Mail::to($order->customer_email)
                            ->send(new OrderPlacedMail($order));
                    }

                    if (config('mail.admin_address')) {
                        Mail::to(config('mail.admin_address'))
                            ->send(new AdminOrderNotificationMail($order));
                    }

                    Log::info('HitPay webhook emails sent for order ' . $order->order_no);
                } catch (\Throwable $e) {
                    Log::error('HitPay webhook email failed for ' . $order->order_no . ' : ' . $e->getMessage());
                }
            }

            return response('OK', 200);
        }

        // ❌ B) 失败/取消/过期：绝对不能把 paid 打回 failed
        if ($isFail) {

            if ($order->status === 'paid') {
                Log::warning('HitPay webhook FAIL ignored because order already paid', [
                    'order_no'      => $order->order_no,
                    'hitpay_status' => $statusRaw,
                    'old_status'    => $oldStatus,
                ]);

                return response('OK', 200);
            }

            $order->update([
                'status'         => 'failed',
                'payment_status' => $statusRaw ?: 'failed',
                'gateway'        => 'hitpay',
            ]);

            Log::info('HitPay webhook marked payment as FAILED', [
                'order_no'      => $order->order_no,
                'hitpay_status' => $statusRaw,
                'old_status'    => $oldStatus,
            ]);

            return response('OK', 200);
        }

        // 其他状态先只记 log（pending / processing 之类）
        Log::info('HitPay webhook unhandled status', [
            'order_no' => $order->order_no,
            'status'   => $statusRaw,
            'old_status' => $oldStatus,
        ]);

        return response('OK', 200);
    }




    // public function handleWebhook(Request $request)
    // {
    //     \Log::info('HitPay API webhook TEST', [
    //         'payload' => $request->all(),
    //         'headers' => $request->headers->all(),
    //     ]);

    //     // 不做任何验证，固定回 200
    //     return response()->json([
    //         'ok'      => true,
    //         'message' => 'Webhook received (test)',
    //     ], 200);
    // }
}
