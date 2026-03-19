<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ShippingRate;
use App\Models\PointLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\OrderPlacedMail;
use App\Mail\AdminOrderNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $items    = $cart->items;
        $subtotal = $items->sum(fn($i) => $i->unit_price * $i->qty);

        $user = auth()->user()?->load('agent');
        $defaultAddress = $user?->defaultAddress;
        $addresses      = $user?->addresses ?? collect();

        $paymentMethods = PaymentMethod::where('is_active', true)
            ->orderByDesc('is_default')
            ->get();

        // ✅ 有没有实体商品
        $hasPhysical = $items->contains(function ($item) {
            return !$item->product->is_digital;   // 没勾 digital = 实体
        });

        $digitalInputProducts = $items
            ->map(fn($item) => $item->product)
            ->filter(fn($product) => $product && $product->is_digital && !empty($product->customer_input_fields))
            ->values();

        // ✅ 先给 shippingFee = null，表示“待计算”
        $shippingFee = null;

        // ✅ 把 rate 丢给前端，用 JS 算（west_my / east_my）
        $shippingRates = $hasPhysical
            ? ShippingRate::pluck('rate', 'code')   // ['west_my' => 8, 'east_my' => 15, ...]
            : collect();                             // 全部 digital 就不用运费了

        $states = [
            // West Malaysia
            ['name' => 'Johor',           'zone' => 'west_my'],
            ['name' => 'Kedah',           'zone' => 'west_my'],
            ['name' => 'Kelantan',        'zone' => 'west_my'],
            ['name' => 'Melaka',          'zone' => 'west_my'],
            ['name' => 'Negeri Sembilan', 'zone' => 'west_my'],
            ['name' => 'Pahang',          'zone' => 'west_my'],
            ['name' => 'Perak',           'zone' => 'west_my'],
            ['name' => 'Perlis',          'zone' => 'west_my'],
            ['name' => 'Penang',          'zone' => 'west_my'],
            ['name' => 'Selangor',        'zone' => 'west_my'],
            ['name' => 'Terengganu',      'zone' => 'west_my'],
            ['name' => 'Kuala Lumpur',    'zone' => 'west_my'],
            ['name' => 'Putrajaya',       'zone' => 'west_my'],

            // East Malaysia
            ['name' => 'Sabah',           'zone' => 'east_my'],
            ['name' => 'Sarawak',         'zone' => 'east_my'],
            ['name' => 'Labuan',          'zone' => 'east_my'],
        ];

        return view('checkout.index', compact(
            'items',
            'subtotal',
            'defaultAddress',
            'addresses',
            'paymentMethods',
            'shippingFee',
            'shippingRates',
            'hasPhysical',
            'states',
            'digitalInputProducts',
        ));
    }



    public function store(Request $request)
    {
        /**
         * 1️⃣ 先读取购物车
         */
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $items = $cart->items;

        if ($items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $user = auth()->user()->load('agent');

        $subtotal = $items->sum(fn($i) => $i->unit_price * $i->qty);

        $hasPhysical = $items->contains(fn($item) => !$item->product->is_digital);

        /**
         * 2️⃣ 动态验证规则
         */
        $rules = [
            'name'            => ['required', 'string', 'max:255'],
            'phone'           => ['required', 'string', 'max:50'],
            'email'           => ['required', 'email', 'max:255'],
            'address_line1'   => [$hasPhysical ? 'required' : 'nullable', 'string', 'max:255'],
            'address_line2'   => ['nullable', 'string', 'max:255'],
            'postcode'        => [$hasPhysical ? 'required' : 'nullable', 'string', 'max:20'],
            'city'            => [$hasPhysical ? 'required' : 'nullable', 'string', 'max:100'],
            'state'           => [$hasPhysical ? 'required' : 'nullable', 'string', 'max:100'],
            'country'         => [$hasPhysical ? 'required' : 'nullable', 'string', 'max:100'],
            'payment_method'  => ['required', 'exists:payment_methods,code'],
            'remark'          => ['nullable', 'string', 'max:500'],
            'payment_receipt' => ['nullable', 'image', 'max:4096'],
            'points_redeemed' => ['nullable', 'numeric', 'min:0'],
        ];

        if ($request->input('payment_method') === 'online_transfer') {
            $rules['payment_receipt'] = ['required', 'image', 'max:4096'];
        }

        foreach ($items as $item) {
            $product = $item->product;

            if (!$product || !$product->is_digital || empty($product->customer_input_fields)) {
                continue;
            }

            foreach ($product->customer_input_fields as $field) {
                $key = $field['key'] ?? null;

                if (!$key) {
                    continue;
                }

                $fieldRules = ['nullable', 'string', 'max:255'];

                if (!empty($field['required'])) {
                    $fieldRules[0] = 'required';
                }

                $rules["digital_inputs.{$product->id}.{$key}"] = $fieldRules;
            }
        }

        $validated = $request->validate($rules);

        /**
         * 3️⃣ 读取 Payment Method
         */
        $paymentMethod = PaymentMethod::where('code', $validated['payment_method'])
            ->where('is_active', true)
            ->firstOrFail();

        /**
         * 4️⃣ 计算运费
         */
        $shippingFee = 0;

        if ($hasPhysical) {
            $eastStates = ['Sabah', 'Sarawak', 'Labuan'];

            $zoneCode = in_array($validated['state'], $eastStates)
                ? 'east_my'
                : 'west_my';

            $shippingFee = (float) (ShippingRate::where('code', $zoneCode)->value('rate') ?? 0);
        } else {
            $shippingFee = (float) (ShippingRate::where('code', 'digital')->value('rate') ?? 0);
        }

        /**
         * 5️⃣ 计算 redeem points
         */
        $availablePoints = (float) ($user->agent->current_points ?? 0);
        $requestedPoints = (float) ($validated['points_redeemed'] ?? 0);

        if ($requestedPoints < 0) {
            $requestedPoints = 0;
        }

        $beforeDiscountTotal = round((float) $subtotal + (float) $shippingFee, 2);

        // 1 point = RM1
        $pointsRedeemed = min($requestedPoints, $availablePoints, $beforeDiscountTotal);
        $pointsRedeemed = round($pointsRedeemed, 2);

        $pointsDiscountRm = $pointsRedeemed;
        $total = max($beforeDiscountTotal - $pointsDiscountRm, 0);
        $total = round($total, 2);

        /**
         * 6️⃣ 处理收据文件
         */
        $receiptPath = null;

        if ($request->hasFile('payment_receipt')) {
            $receiptPath = $request->file('payment_receipt')
                ->store('payment_receipts', 'public');
        }

        /**
         * 7️⃣ 生成订单编号
         */
        do {
            $orderNo = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (Order::where('order_no', $orderNo)->exists());

        /**
         * 8️⃣ 建立订单 + 扣 points
         */
        $order = null;

        DB::transaction(function () use (
            $validated,
            $request,
            $items,
            $subtotal,
            $shippingFee,
            $paymentMethod,
            $receiptPath,
            $cart,
            $orderNo,
            $total,
            $hasPhysical,
            $user,
            $pointsRedeemed,
            $pointsDiscountRm,
            &$order
        ) {
            $order = Order::create([
                'order_no'             => $orderNo,
                'user_id'              => auth()->id(),
                'customer_name'        => $validated['name'],
                'customer_phone'       => $validated['phone'],
                'customer_email'       => $validated['email'],
                'address_line1'        => $hasPhysical ? ($validated['address_line1'] ?? null) : null,
                'address_line2'        => $hasPhysical ? ($validated['address_line2'] ?? null) : null,
                'postcode'             => $hasPhysical ? ($validated['postcode'] ?? null) : null,
                'city'                 => $hasPhysical ? ($validated['city'] ?? null) : null,
                'state'                => $hasPhysical ? ($validated['state'] ?? null) : null,
                'country'              => $hasPhysical ? ($validated['country'] ?? null) : null,
                'subtotal'             => $subtotal,
                'points_redeemed'      => $pointsRedeemed,
                'points_discount_rm'   => $pointsDiscountRm,
                'shipping_fee'         => $shippingFee,
                'total'                => $total,
                'status'               => 'pending',
                'payment_method_code'  => $paymentMethod->code,
                'payment_method_name'  => $paymentMethod->name,
                'payment_receipt_path' => $receiptPath,
                'remark'               => $validated['remark'] ?? null,
            ]);

            foreach ($items as $item) {
                $product = $item->product;

                $customerInputData = null;

                if ($product && $product->is_digital && !empty($product->customer_input_fields)) {
                    $customerInputData = $request->input("digital_inputs.{$product->id}", []);
                }

                $order->items()->create([
                    'product_id'          => $item->product_id,
                    'product_name'        => $product->name ?? '',
                    'qty'                 => $item->qty,
                    'unit_price'          => $item->unit_price,
                    'product_variant_id'  => $item->product_variant_id ?? null,
                    'variant_label'       => $item->variant_label ?? null,
                    'customer_input_data' => $customerInputData,
                ]);
            }

            if ($pointsRedeemed > 0 && $user->agent) {
                $user->agent->decrement('current_points', $pointsRedeemed);

                PointLog::create([
                    'agent_id'       => $user->agent->id,
                    'type'           => 'redeem',
                    'direction'      => 'out',
                    'points'         => $pointsRedeemed,
                    'reference_type' => 'order',
                    'reference_id'   => $order->id,
                    'remark'         => 'Redeemed points for order #' . $order->order_no,
                ]);
            }

            $cart->items()->delete();
        });

        /**
         * 9️⃣ 发邮件
         */
        $isHitpay = $paymentMethod->code === 'hitpay';

        if ($order) {
            Log::info('Checkout order created: ' . $order->order_no);
            Log::info('Config admin_address is: ' . config('mail.admin_address'));

            if (! $isHitpay) {
                try {
                    if ($order->customer_email) {
                        Log::info('Sending customer email for order: ' . $order->order_no);
                        Mail::to($order->customer_email)->send(new OrderPlacedMail($order));
                    }

                    if (config('mail.admin_address')) {
                        Log::info('Sending admin email for order: ' . $order->order_no);
                        Mail::to(config('mail.admin_address'))->send(new AdminOrderNotificationMail($order));
                    }
                } catch (\Throwable $e) {
                    Log::error('Order email send failed for ' . $order->order_no . ' : ' . $e->getMessage());
                }
            }
        }

        /**
         * 🔟 HitPay
         */
        if ($isHitpay) {
            return redirect()->route('hitpay.pay', $order);
        }

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        // 安全检查：只能看自己的订单
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        // 可选：只允许已付款 / 处理中订单访问
        if (! in_array($order->status, ['pending', 'paid'])) {
            return redirect()
                ->route('account.orders.index')
                ->with('error', 'This order is not available.');
        }

        return view('checkout.success', compact('order'));
    }
}
