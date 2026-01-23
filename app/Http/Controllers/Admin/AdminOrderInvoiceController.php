<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderInvoiceController extends Controller
{
    public function preview(Order $order)
    {
        $order->load(['items', 'items.product']); // 需要啥就 load 啥

        $pdf = Pdf::loadView('admin.orders.invoice', [
            'order' => $order,
        ])->setPaper('A4', 'portrait');

        // 直接在浏览器预览
        return $pdf->stream("invoice-{$order->order_no}.pdf");
    }
}
