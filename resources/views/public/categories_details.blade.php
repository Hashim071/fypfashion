@extends('layouts.public_layout') {{-- Use your master layout --}}

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Shop</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}">
                        <i class="flaticon-home"></i> Home
                    </a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">{{ $category->name ?? 'Shop' }}</span>
                </div>
            </div>
        </div>
        <div class="ul-inner-page-container">
            <div class="ul-inner-products-wrapper">
                <div class="row ul-bs-row flex-column-reverse flex-md-row">

                    <div class="col-lg-3 col-md-4">
                        <div class="ul-products-sidebar">

                            <div class="ul-products-sidebar-widget ul-products-search">
                                <form action="#" class="ul-products-search-form">
                                    <input type="text" name="product-search" id="ul-products-search-field"
                                        placeholder="Search Items">
                                    <button><i class="flaticon-search-interface-symbol"></i></button>
                                </form>
                            </div>

                            <div class="ul-products-sidebar-widget ul-products-price-filter">
                                <h3 class="ul-products-sidebar-widget-title">Filter by price</h3>
                                <form action="#" class="ul-products-price-filter-form">
                                    <div id="ul-products-price-filter-slider"></div>
                                    <span class="filtered-price">$19 - $69</span>
                                </form>
                            </div>

                            @if (isset($allCategories) && $allCategories->count() > 0)
                                <div class="ul-products-sidebar-widget ul-products-categories">
                                    <h3 class="ul-products-sidebar-widget-title">Categories</h3>
                                    <div class="ul-products-categories-link">
                                        @foreach ($allCategories as $cat)
                                            <a href="" class="{{ $cat->id == $category->id ? 'active' : '' }}">
                                                <span>
                                                    <i class="flaticon-arrow-point-to-right"></i> {{ $cat->name }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- NOTE: The following filter widgets are STATIC HTML. You will need to add backend logic to make them work. --}}

                            <div class="ul-products-sidebar-widget ul-products-color-filter">
                                <h3 class="ul-products-sidebar-widget-title">Filter By Color</h3>
                                <div class="ul-products-color-filter-colors">
                                    <a href="#" class="black"><span class="left"><span class="color-prview"></span>
                                            Black</span><span>14</span></a>
                                    <a href="#" class="green"><span class="left"><span class="color-prview"></span>
                                            Green</span><span>14</span></a>
                                    <a href="#" class="blue"><span class="left"><span class="color-prview"></span>
                                            Blue</span><span>14</span></a>
                                </div>
                            </div>

                            <div class="ul-products-sidebar-widget">
                                <h3 class="ul-products-sidebar-widget-title">Filter By Sizes</h3>
                                <div class="ul-products-color-filter-colors">
                                    <a href="#"><span class="left">S</span><span>14</span></a>
                                    <a href="#"><span class="left">L</span><span>14</span></a>
                                    <a href="#"><span class="left">M</span><span>14</span></a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8">
                        <h2>{{ $category->name }}</h2>
                        <p>{{ $category->description }}</p>

                        <div class="row ul-bs-row row-cols-lg-3 row-cols-2 row-cols-xxs-1">
                            @forelse ($products as $product)
                                <div class="col">
                                    <div class="ul-product">
                                        <div class="ul-product-heading">
                                            <span
                                                class="ul-product-price">${{ number_format($product->retail_price, 2) }}</span>
                                            @if ($product->actual_price > $product->retail_price)
                                                <span
                                                    class="ul-product-discount-tag">{{ round((($product->actual_price - $product->retail_price) / $product->actual_price) * 100) }}%
                                                    Off</span>
                                            @endif
                                        </div>

                                        <div class="ul-product-img">
                                            @if (Str::startsWith($product->image, 'admin/'))
                                                {{-- ✅ Seeder wali image jo 'public' folder mein hai --}}
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                {{-- ✅ Form se upload hui image jo 'storage' folder mein hai --}}
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
                                            @endif
                                            <div class="ul-product-actions">
                                                {{-- Yahan route ko product ka parameter pass karein --}}
                                                <a href="{{ route('public.product.details', $product->id) }}">
                                                    <i class="flaticon-shopping-bag"></i>
                                                </a>

                                                <a href="{{ route('cart.add', $product->id) }}">
                                                    <i class="flaticon-heart"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="ul-product-txt">
                                            <h4 class="ul-product-title"><a
                                                    href="{{ route('public.product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h4>
                                            <h3 class="ul-product-category"><a href="">{{ $category->name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>No products found in this category.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
