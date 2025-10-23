<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Order #{{ $order->id }}</title>
    <style>
        body { font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #555; background-color: #fff; font-size: 14px; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 2px solid #eee; }
        .invoice-header .logo { font-size: 28px; font-weight: bold; color: #333; }
        .invoice-header .invoice-details { text-align: right; }
        .invoice-details h2 { margin: 0; font-size: 24px; color: #333; }
        .invoice-details p { margin: 2px 0; }
        .customer-details { margin-bottom: 40px; }
        .customer-details h3 { margin-bottom: 10px; font-size: 16px; color: #333; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .customer-details p { margin: 2px 0; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f9f9f9; font-weight: bold; color: #333; }
        .totals-table { width: 50%; margin-left: auto; border: none; }
        .totals-table td { border: none; padding: 8px 0; }
        .totals-table .label { text-align: right; padding-right: 20px; font-weight: bold; }
        .grand-total { font-size: 18px; font-weight: bold; color: #333; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #888; }
        .customization-details { font-size: 12px; color: #777; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <div class="logo">Custom Couture</div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p><strong>Invoice #:</strong> INV-{{ $order->id }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
            </div>
        </div>
        <div class="customer-details">
            <h3>Bill To:</h3>
            <p><strong>{{ $order->user->name ?? 'N/A' }}</strong></p>
            <p>{{ $order->delivery_address }}</p>
            <p>{{ $order->user->email ?? '' }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Details</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $item->product->name ?? 'Product not found' }}
                            @if ($item->customization)
                                <div class="customization-details">
                                    <strong>Size:</strong> {{ $item->customization->size ?? 'N/A' }} |
                                    <strong>Color:</strong> {{ $item->customization->color ?? 'N/A' }} |
                                    <strong>Fabric:</strong> {{ $item->customization->fabric ?? 'N/A' }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs {{ number_format($item->price, 2) }}</td>
                        <td>Rs {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="totals-table">
            <tbody>
                <tr>
                    <td class="label grand-total">Grand Total</td>
                    <td class="grand-total">Rs {{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Thank you for your business!</p>
            <p>Custom Couture</p>
        </div>
    </div>
</body>
</html>
