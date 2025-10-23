@extends('layouts.public_layout') {{-- Apna master layout istemal karein --}}

@section('content')
<main>
    <div class="ul-cart-container" style="text-align: center; padding: 40px 15px;">
        <h3 class="ul-checkout-title">Thank You! Your Order is Confirmed!</h3>
        <p>A confirmation Message has been sent. Your order details are shown below for your reference.</p>

        <div class="ul-checkout-bill-summary" style="max-width: 700px; margin: 30px auto; text-align: left;">
            <h4 class="ul-checkout-bill-summary-title">Order Summary</h4>
            <div>
                {{-- ✅ START: Order Details Section --}}
                <div class="ul-checkout-bill-summary-body" style="padding-bottom: 0;">
                    <div class="single-row">
                        <span class="left">Order ID</span>
                        <span class="right fw-bold">#{{ $order->id }}</span>
                    </div>
                    <div class="single-row">
                        <span class="left">Name</span>
                        <span class="right">{{ $order->user->name }}</span>
                    </div>
                    <div class="single-row">
                        <span class="left">Delivery Address</span>
                        <span class="right">{{ $order->delivery_address }}</span>
                    </div>
                    <div class="single-row">
                        <span class="left">Payment Method</span>
                        {{-- ✅ Payment method ko dynamic banaya gaya hai --}}
                        <span class="right" style="text-transform: capitalize;">
                            {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'PayFast' }}
                        </span>
                    </div>
                     <div class="single-row">
                        <span class="left">Order Status</span>
                        <span class="right" style="text-transform: capitalize;">{{ $order->status }}</span>
                    </div>
                </div>
                {{-- END: Order Details Section --}}

                {{-- ✅ START: Order Items Section --}}
                <div class="ul-checkout-bill-summary-header" style="margin-top: 20px;">
                    <span class="left">Product</span>
                    <span class="right">Sub Total</span>
                </div>
                <div class="ul-checkout-bill-summary-body">
                    @foreach($order->items as $item)
                        <div class="single-row">
                            <span class="left">{{ $item->product->name ?? 'Product not found' }} &nbsp; <strong>× {{ $item->quantity }}</strong></span>
                            <span class="right">Rs.{{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>
                {{-- END: Order Items Section --}}

                <div class="ul-checkout-bill-summary-footer ul-checkout-bill-summary-header">
                    <span class="left">Total Amount</span>
                    {{-- ✅ Currency ko theek kiya gaya hai --}}
                    <span class="right">Rs.{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <a href="{{ route('public.home') }}" class="ul-checkout-form-btn" style="display: inline-block; text-decoration: none;">Continue Shopping</a>
    </div>
</main>
@endsection
