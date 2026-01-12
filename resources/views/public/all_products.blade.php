@extends('layouts.public_layout')

@section('title', 'All Products - Custom Couture')

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">All Products</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Shop</span>
                </div>
            </div>
        </div>

        <div class="ul-inner-page-container">
            <div class="ul-inner-products-wrapper">
                <div class="ul-container">
                    <div class="row ul-bs-row row-cols-lg-4 row-cols-md-3 row-cols-2 row-cols-xxs-1 g-4">

                        @forelse ($products as $product)
                            <div class="col">
                                <div class="ul-product">
                                    <div class="ul-product-heading">
                                        <span
                                            class="ul-product-price">${{ number_format($product->retail_price, 2) }}</span>

                                        @if ($product->actual_price > $product->retail_price)
                                            @php
                                                $discount =
                                                    (($product->actual_price - $product->retail_price) /
                                                        $product->actual_price) *
                                                    100;
                                            @endphp
                                            <span class="ul-product-discount-tag">{{ round($discount) }}% Off</span>
                                        @endif
                                    </div>

                                    <div class="ul-product-img">
                                        @if ($product->image)
                                            @if (Str::startsWith($product->image, 'admin/'))
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                            @endif
                                        @else
                                            <img src="{{ asset('assets/img/default-product.png') }}" alt="No Image">
                                        @endif

                                        <div class="ul-product-actions">
                                            <a href="{{ route('public.product.details', $product->id) }}">
                                                <i class="flaticon-shopping-bag"></i>
                                            </a>
                                            <a href="{{ route('cart.add', $product->id) }}">
                                                <i class="flaticon-heart"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="ul-product-txt">
                                        <h4 class="ul-product-title">
                                            <a
                                                href="{{ route('public.product.details', $product->id) }}">{{ $product->name }}</a>
                                        </h4>
                                        <h5 class="ul-product-category">
                                            <a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p>No products available at the moment.</p>
                            </div>
                        @endforelse

                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
