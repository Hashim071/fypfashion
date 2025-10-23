@extends('layouts.public_layout')

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Your Cart</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ url('/') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Cart</span>
                </div>
            </div>
        </div>

        <div class="ul-cart-container">
            <div class="cart-top">
                <div class="text-center">
                    <!-- cart header -->
                    <div class="ul-cart-header ul-wishlist-header">
                        <div>Product</div>
                        <div>Price</div>
                        <div>Qty</div>
                        <div>Subtotal</div>
                        <div>Remove</div>
                    </div>

                    <!-- cart body -->
                    <div>
                        @forelse ($cart as $item)
                            <div class="ul-cart-item">
                                <!-- product -->
                                <div class="ul-cart-product">
                                    <a href="{{ route('public.place_order', $item['id']) }}" class="ul-cart-product-img">
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}">
                                    </a>
                                    <a href="{{ route('public.place_order', $item['id']) }}" class="ul-cart-product-title">
                                        {{ $item['name'] }}
                                    </a>
                                </div>

                                <!-- price -->
                                <span class="ul-cart-item-price">${{ number_format($item['price'], 2) }}</span>

                                <!-- quantity -->
                                <div class="ul-cart-item-qty d-flex align-items-center justify-content-center gap-2">
                                    <span class="qty-value" id="qty-{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                </div>

                                <!-- subtotal -->
                                <span class="ul-cart-item-subtotal" id="subtotal-{{ $item['id'] }}">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </span>

                                <!-- remove -->
                                <div class="ul-cart-item-remove">
                                    <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-sm text-danger">
                                        <i class="flaticon-close"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="py-5 text-gray-500">Your cart is empty 😔</p>
                        @endforelse
                    </div>

                    @if (count($cart))
                        <div class="text-end mt-4">
                            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger me-2">Clear Cart</a>
                            @if (count($cart))
                                <a href="{{ route('public.place_order', array_key_first($cart)) }}"
                                    class="btn btn-primary">
                                    Proceed to Checkout
                                </a>
                            @endif

                        </div>
                    @endif
                    @if (count($cart))
                        @php($total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)))
                        <div class="text-end mt-4 pe-4">
                            <div class="fw-bold fs-5">Total: <span
                                    class="cart-total">${{ number_format($total, 2) }}</span></div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>

@endsection
