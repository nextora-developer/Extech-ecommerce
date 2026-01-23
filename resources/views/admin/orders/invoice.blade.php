<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_no }}</title>
    <style>
        /* PDF engines prefer specific point/pixel values */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            /* Cleaner than DejaVu for tech feel */
            font-size: 11px;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .wrap {
            padding: 40px;
        }

        /* Tech Branding Colors */
        .accent {
            color: #15A5ED;
        }

        .muted {
            color: #64748b;
        }

        .bg-light {
            background-color: #f8fafc;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1e293b;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .h1 {
            font-size: 28px;
            font-weight: 900;
            margin: 0;
            letter-spacing: -1px;
            color: #0f172a;
        }

        /* Layout Cards */
        .info-grid {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-column {
            width: 50%;
            vertical-align: top;
        }

        .label {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 5px;
        }

        /* Items Table */
        table.items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .items-table th {
            background-color: #0f172a;
            color: #ffffff;
            padding: 10px 12px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            border: none;
        }

        .items-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        /* Summary Area */
        .summary-container {
            width: 100%;
            margin-top: 20px;
        }

        .total-row td {
            padding: 6px 12px;
        }

        .grand-total-box {
            background-color: #f1f5f9;
            border-top: 2px solid #15A5ED;
            margin-top: 10px;
            padding: 15px;
            text-align: right;
        }

        .right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrap">
        {{-- Top Header --}}
        <table class="header-table">
            <tr>
                <td>
                    <div class="h1">INVOICE</div>
                    <div style="margin-top: 5px;">
                        <span class="muted">Transaction ID:</span>
                        <span class="font-bold">#{{ $order->order_no }}</span>
                    </div>
                </td>
                <td class="right">
                    <div style="font-size: 18px; font-weight: bold; color: #15A5ED;">EXTECH STUDIO</div>
                    <div class="muted">EX-TECH_CORE_V1.0</div>
                    <div class="muted">cs.extechstudio@gmail.com</div>
                </td>
            </tr>
        </table>

        {{-- Address Grid --}}
        <table class="info-grid">
            <tr>
                <td class="info-column">
                    <div class="label">Issued To</div>
                    <div style="font-size: 14px; font-weight: bold;">{{ $order->customer_name ?? 'Guest User' }}</div>
                    <div class="muted">{{ $order->customer_email }}</div>
                    <div class="muted">{{ $order->customer_phone }}</div>
                </td>
                <td class="info-column">
                    <div class="label">Shipping Destination</div>
                    <div>
                        {{ $order->address_line1 }}<br>
                        @if ($order->address_line2)
                            {{ $order->address_line2 }}<br>
                        @endif
                        <span class="font-bold">{{ $order->postcode }} {{ $order->city }}</span><br>
                        {{ $order->state }}, Malaysia
                    </div>
                </td>
            </tr>
        </table>

        @php
            $orderStatus = strtoupper($order->status ?? '—');
            $paymentStatus = strtolower($order->payment_status ?? '');

            // 显示文案
            if ($orderStatus === 'PAID' || $paymentStatus === 'completed') {
                $statusText = 'PAID · VERIFIED';
                $statusColor = '#16a34a'; // green
                $borderColor = '#22c55e';
                $bgColor = '#f0fdf4';
            } elseif ($orderStatus === 'PENDING') {
                $statusText = 'PENDING PAYMENT';
                $statusColor = '#ca8a04'; // amber
                $borderColor = '#facc15';
                $bgColor = '#fffbeb';
            } elseif ($orderStatus === 'FAILED' || $paymentStatus === 'failed') {
                $statusText = 'PAYMENT FAILED';
                $statusColor = '#dc2626'; // red
                $borderColor = '#ef4444';
                $bgColor = '#fef2f2';
            } elseif ($orderStatus === 'CANCELLED') {
                $statusText = 'CANCELLED';
                $statusColor = '#6b7280'; // gray
                $borderColor = '#9ca3af';
                $bgColor = '#f9fafb';
            } else {
                $statusText = $orderStatus;
                $statusColor = '#2563eb'; // blue
                $borderColor = '#3b82f6';
                $bgColor = '#eff6ff';
            }
        @endphp

        {{-- Date and Real Status --}}
        <div
            style="margin-bottom: 20px; padding: 12px; border-left: 3px solid {{ $borderColor }}; background: {{ $bgColor }};">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td>
                        <span class="muted uppercase" style="font-size: 9px; letter-spacing: .12em;">
                            Deployment Date
                        </span><br>
                        <strong>{{ optional($order->created_at)->format('d F Y') }}</strong>
                    </td>

                    <td class="right">
                        <span class="muted uppercase" style="font-size: 9px; letter-spacing: .12em;">
                            Status
                        </span><br>
                        <strong style="color: {{ $statusColor }};">
                            {{ $statusText }}
                        </strong>
                    </td>
                </tr>
            </table>
        </div>


        {{-- Items Table --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width:55%;">Unit Description</th>
                    <th style="width:10%;" class="right">Qty</th>
                    <th style="width:15%;" class="right">Unit Price</th>
                    <th style="width:20%;" class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <div class="font-bold" style="font-size: 12px; color: #0f172a;">
                                {{ $item->product_name ?? ($item->product->name ?? 'Unknown Hardware') }}
                            </div>
                            @if ($item->variant_label)
                                <div class="muted" style="font-size: 9px; margin-top: 3px; font-family: monospace;">
                                    [{{ $item->variant_label }}: {{ $item->variant_value }}]
                                </div>
                            @endif
                        </td>
                        <td class="right font-bold">{{ $item->qty ?? 1 }}</td>
                        <td class="right">RM{{ number_format($item->unit_price, 2) }}</td>
                        <td class="right font-bold">RM{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Financial Summary --}}
        <table class="summary-container">
            <tr>
                <td style="width: 60%; vertical-align: top; padding-top: 20px;">
                    @if ($order->remark)
                        <div class="label">System Notes</div>
                        <div class="muted" style="font-style: italic;">"{{ $order->remark }}"</div>
                    @endif
                </td>
                <td style="width: 40%;">
                    <table style="width: 100%;">
                        <tr class="total-row">
                            <td class="right muted">Subtotal</td>
                            <td class="right font-bold">RM{{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td class="right muted">Shipping Fee</td>
                            <td class="right font-bold">RM{{ number_format($order->shipping_fee, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="grand-total-box">
                                    <div class="label" style="color: #64748b; margin-bottom: 2px;">Total Payable</div>
                                    <div style="font-size: 22px; font-weight: 900; color: #0f172a;">
                                        RM {{ number_format($order->total, 2) }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- Footer --}}
        <div style="margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center;">
            <div class="muted" style="font-size: 9px; letter-spacing: 1px;">
                THIS IS A COMPUTER GENERATED DOCUMENT. NO SIGNATURE IS REQUIRED.
            </div>
            <div class="accent font-bold" style="margin-top: 5px; font-size: 10px;">
                WWW.EXTECHSTUDIO.XYZ
            </div>
        </div>
    </div>
</body>

</html>
