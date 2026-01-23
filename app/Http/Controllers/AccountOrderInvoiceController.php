<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountOrderInvoiceController extends Controller
{
    protected function authorizeOrder(Order $order): void
    {
        // ✅ 你的订单若有 user_id，就用这个最稳
        if (!empty($order->user_id) && (int) $order->user_id !== (int) auth()->id()) {
            abort(403);
        }

        // 如果你有 guest order 逻辑（用 email/phone），也可以在这里加规则
    }

    public function preview(Order $order)
    {
        $this->authorizeOrder($order);

        $order->load(['items', 'items.product']);

        $pdf = Pdf::loadView('admin.orders.invoice', ['order' => $order])
            ->setPaper('A4', 'portrait');

        return $pdf->stream("invoice-{$order->order_no}.pdf");
    }
}
