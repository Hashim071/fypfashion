@extends('layouts.public_layout')

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Checkout</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Checkout</span>
                </div>
            </div>
        </div>
        <div class="ul-cart-container">
            <h3 class="ul-checkout-title">Billing Details</h3>

            {{-- ✅ CHANGE 1: Added enctype for image uploads --}}
            {{-- ✅✅ FINAL AND COMPLETE FORM CODE ✅✅ --}}

            <form action="{{ route('public.place_order.submit', $product->id) }}" method="POST" class="ul-checkout-form"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">

                {{-- ✅✅ YEH BLOCK WAPIS ADD KAREIN - Sab se Zaroori Step --}}
                {{-- Yeh block size, color, fabric, etc., ko POST request mein shamil karega --}}
                @if (!empty($customizations))
                    @foreach ($customizations as $key => $value)
                        {{-- Hum reference image ka sirf naam bhej rahe the, usko yahan se skip karein --}}
                        @if ($key !== 'reference_image_name')
                            <input type="hidden" name="custom[{{ $key }}]" value="{{ $value }}">
                        @endif
                    @endforeach
                @endif
                {{-- END OF MISSING BLOCK --}}


                <div class="row ul-bs-row row-cols-2 row-cols-xxs-1">
                    <div class="col">
                        {{-- Error Display Block --}}
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row row-cols-lg-2 row-cols-1 ul-bs-row">
                            {{-- Name, Address, Phone, Email fields --}}
                            <div class="form-group">
                                <label for="name">Full Name*</label>
                                <input type="text" name="name" id="name" placeholder="Enter Your Full Name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Full Address*</label>
                                <input type="text" name="address" id="address" placeholder="House no, Street name"
                                    value="{{ old('address') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone*</label>
                                <input type="text" name="phone" id="phone" placeholder="Enter Your Phone Number"
                                    value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address*</label>
                                <input type="email" name="email" id="email" placeholder="Enter Your Email"
                                    value="{{ old('email') }}" required>
                            </div>

                            {{-- Image Upload Field --}}
                            @if ($product->is_customizable)
                                <div class="form-group col-lg-12">
                                    <label for="reference_image">Reference Image (Optional)</label>
                                    <input type="file" name="reference_image" id="reference_image" class="form-control">
                                    @if (isset($customizations['reference_image_name']))
                                        <small class="form-text text-muted">You selected:
                                            {{ $customizations['reference_image_name'] }}. Please re-upload to
                                            confirm.</small>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Payment Method & Submit Button --}}
                    <div class="col">
                        <div class="ul-checkout-payment-methods">
                            <div class="form-group ul-checkout-country-wrapper">
                                <label for="payment_method">Select Payment Method*</label>
                                <select name="payment_method" id="payment_method" required>
                                    <option value="cod">Cash on Delivery</option>
                                    <option value="payfast">Pay with PayFast (Credit/Debit Card)</option>
                                </select>
                            </div>
                            <button type="submit" class="ul-checkout-form-btn">Place Your Order</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row ul-bs-row row-cols-2 row-cols-xxs-1">
                <div class="ul-checkout-bill-summary">
                    <h4 class="ul-checkout-bill-summary-title">Your Order</h4>
                    <div>
                        {{-- ✅ CHANGE 4: Display customization summary to the user --}}
                        @if (!empty(array_filter($customizations)))
                            <div style="padding: 15px; border: 1px dashed #ddd; margin-bottom: 20px;">
                                <h5 style="margin-bottom: 10px; font-weight: bold;">Customization Details:</h5>
                                <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                                    @foreach ($customizations as $key => $value)
                                        @if ($value)
                                            <li style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                                <span>{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                <span
                                                    style="text-align: right;"><strong>{{ $value }}</strong></span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="ul-checkout-bill-summary-header">
                            <span class="left">Product</span>
                            <span class="right">Sub Total</span>
                        </div>

                        <div class="ul-checkout-bill-summary-body">
                            <div class="single-row">
                                <span class="left">{{ $product->name }} &nbsp; <strong>×
                                        {{ $quantity }}</strong></span>
                                <span class="right">Rs.{{ number_format($product->retail_price * $quantity, 2) }}</span>
                            </div>
                            <div class="single-row">
                                <span class="left">Sub Total</span>
                                <span class="right">Rs.{{ number_format($product->retail_price * $quantity, 2) }}</span>
                            </div>
                            <div class="single-row">
                                <span class="left">Shipping</span>
                                <span class="right">Free</span>
                            </div>
                        </div>

                        <div class="ul-checkout-bill-summary-footer ul-checkout-bill-summary-header">
                            <span class="left">Total</span>
                            <span class="right">Rs.{{ number_format($product->retail_price * $quantity, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
