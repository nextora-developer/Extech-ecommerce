<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $q = Order::query();

        // Filters
        if ($request->filled('status')) {
            $q->where('status', $request->string('status'));
        }

        if ($request->filled('keyword')) {
            $keyword = $request->string('keyword');
            $q->where(function ($qq) use ($keyword) {
                $qq->where('order_no', 'like', "%{$keyword}%")
                    ->orWhere('customer_name', 'like', "%{$keyword}%")
                    ->orWhere('customer_phone', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('from')) {
            $q->whereDate('created_at', '>=', $request->date('from'));
        }

        if ($request->filled('to')) {
            $q->whereDate('created_at', '<=', $request->date('to'));
        }

        $orders = $q->latest()->paginate(10)->withQueryString();

        $statuses = ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled', 'failed'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $statuses = ['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled', 'failed'];

        // 先记住旧状态
        $oldStatus = $order->status;

        // 确保 items + product 有载入
        $order->loadMissing('items.product');

        // 判断这张订单有没有实体商品
        $hasPhysicalItems = $order->items->contains(function ($item) {
            return !($item->product?->is_digital);
        });

        $rules = [
            'status' => ['required', Rule::in($statuses)],
        ];

        if ($hasPhysicalItems) {
            // 实体商品：只有 shipped / completed 需要物流资料
            $needShipping = in_array($request->input('status'), ['shipped', 'completed']);

            $rules['shipping_courier'] = [$needShipping ? 'required' : 'nullable', 'string', 'max:100'];
            $rules['tracking_number'] = [$needShipping ? 'required' : 'nullable', 'string', 'max:120'];
            $rules['shipped_at'] = ['nullable', 'date'];
        } else {
            // 数码商品：processing / completed 时显示 note + processed_at
            $needDigitalFields = in_array($request->input('status'), ['processing', 'completed']);

            $rules['admin_note'] = [$needDigitalFields ? 'required' : 'nullable', 'string', 'max:2000'];
            $rules['processed_at'] = ['nullable', 'date'];
        }

        $validated = $request->validate($rules);

        $data = [
            'status' => $validated['status'],
        ];

        if ($hasPhysicalItems) {
            if (in_array($validated['status'], ['shipped', 'completed'])) {
                $data['shipping_courier'] = $validated['shipping_courier'] ?? $order->shipping_courier;
                $data['tracking_number'] = $validated['tracking_number'] ?? $order->tracking_number;
                $data['shipped_at'] = $validated['shipped_at'] ?? ($order->shipped_at ?? now());
            }
        } else {
            if (in_array($validated['status'], ['processing', 'completed'])) {
                $data['admin_note'] = $validated['admin_note'] ?? $order->admin_note;
                $data['processed_at'] = $order->processed_at ?: now();
            }
        }

        $order->update($data);

        $order->refresh();

        $newStatus = $order->status;

        if ($oldStatus !== $newStatus && $order->customer_email) {
            Log::info('Order status update mail triggered', [
                'order_no'   => $order->order_no,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'email'      => $order->customer_email,
            ]);

            try {
                Mail::to($order->customer_email)
                    ->send(new OrderStatusUpdatedMail($order, $oldStatus, $newStatus));

                Log::info('Order status email sent successfully', [
                    'order_no' => $order->order_no,
                    'to'       => $order->customer_email,
                ]);
            } catch (\Throwable $e) {
                Log::error('Order status email FAILED', [
                    'order_no' => $order->order_no,
                    'to'       => $order->customer_email,
                    'error'    => $e->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Order status updated.');
    }
}
