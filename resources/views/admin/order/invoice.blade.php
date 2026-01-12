<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background: #f1f5f9;
            padding: 50px;
            margin: 0;
        }

        .invoice-wrapper {
            background: #fff;
            max-width: 900px;
            margin: 0 auto;
            border-radius: 4px;
            /* Minimalist sharp edges */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            padding: 60px;
            position: relative;
            border-top: 8px solid #be185d;
            /* Custom Couture Signature Color */
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 60px;
        }

        .brand-h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #be185d;
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }

        .meta-info {
            text-align: right;
        }

        .meta-info h2 {
            margin: 0;
            font-size: 40px;
            font-weight: 300;
            color: #94a3b8;
            line-height: 1;
        }

        .order-id {
            font-weight: 600;
            font-size: 16px;
            margin-top: 10px;
            color: #1e293b;
        }

        .billing-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 100px;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 1px solid #f1f5f9;
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .value {
            font-size: 14px;
            line-height: 1.6;
        }

        /* Icon/Background Fix for Admin Panel as per Sir's Request */
        .status-pill {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .paid {
            background: #f0fdf4;
            color: #166534;
        }

        .unpaid {
            background: #fff1f2;
            color: #9f1239;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            text-align: left;
            padding: 15px 0;
            border-bottom: 2px solid #1e293b;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
        }

        td {
            padding: 20px 0;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .product-name {
            font-weight: 600;
            font-size: 15px;
            display: block;
        }

        .custom-note {
            font-size: 12px;
            color: #be185d;
            background: #fdf2f8;
            padding: 2px 6px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 5px;
        }

        .footer-summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
        }

        .summary-box {
            width: 300px;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }

        .grand-total {
            border-top: 2px solid #1e293b;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #be185d;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .invoice-wrapper {
                box-shadow: none;
                border: none;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="invoice-wrapper">
        <div class="header">
            <div>
                <h1 class="brand-h1">Custom Couture</h1>
                <p style="margin: 5px 0; font-size: 13px; color: #64748b;">Elegance Redefined. Made for You.</p>
            </div>
            <div class="meta-info">
                <h2>INVOICE</h2>
                <div class="order-id">#INV-{{ $order->id }}</div>
                <div style="font-size: 13px; color: #64748b; margin-top: 5px;">Date:
                    {{ $order->created_at->format('M d, Y') }}</div>
            </div>
        </div>

        <div class="billing-grid">
            <div class="address-box">
                <div class="label">Client Information</div>
                <div class="value">
                    <strong>{{ $order->user->name ?? 'Valued Customer' }}</strong><br>
                    {{ $order->delivery_address }}<br>
                    {{ $order->user->email ?? '' }}
                </div>
            </div>
            <div class="payment-box">
                <div class="label">Payment Details</div>
                <div class="value">
                    Method: {{ strtoupper($order->payment_method) }}<br>
                    Status: <span class="status-pill {{ $order->payment_status == 'paid' ? 'paid' : 'unpaid' }}">
                        {{ $order->payment_status }}
                    </span>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="60%">Item Description</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <span class="product-name">{{ $item->product->name ?? 'Artisan Piece' }}</span>
                            @if ($item->customization)
                                <span class="custom-note">
                                    {{ $item->customization->fabric }} | {{ $item->customization->size }} |
                                    {{ $item->customization->color }}
                                </span>
                            @endif
                        </td>
                        <td style="font-size: 14px;">{{ $item->quantity }}</td>
                        <td style="text-align: right; font-weight: 600; font-size: 14px;">Rs
                            {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer-summary">
            <div class="summary-box">
                <div class="summary-line">
                    <span style="color: #94a3b8;">Subtotal</span>
                    <span>Rs {{ number_format($order->items->sum('subtotal'), 2) }}</span>
                </div>
                <div class="summary-line">
                    <span style="color: #94a3b8;">Shipping</span>
                    <span>Calculated at Checkout (Free)</span>
                </div>
                <div class="summary-line grand-total">
                    <span>Total Amount</span>
                    <span>Rs {{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <div
            style="margin-top: 80px; font-size: 11px; color: #94a3b8; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 20px;">
            Questions? Contact us at support@customcouture.pk | Website: www.customcouture.pk
        </div>
    </div>

</body>

</html>
