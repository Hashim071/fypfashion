@extends('layouts.public_layout') {{-- Aapki layout file ka name --}}

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Search Results</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}">
                        <i class="flaticon-home"></i> Home
                    </a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">"{{ $query }}"</span>
                </div>
            </div>
        </div>

        <div class="ul-inner-page-container">
            <div class="ul-inner-products-wrapper">
                <div class="row ul-bs-row flex-column-reverse flex-md-row">

                    {{-- Sidebar --}}
                    <div class="col-lg-3 col-md-4">
                        <div class="ul-products-sidebar">
                            {{-- Search Widget (Sidebar) --}}
                            <div class="ul-products-sidebar-widget ul-products-search">
                                <form action="{{ route('public.search') }}" method="GET" class="ul-products-search-form">
                                    <input type="text" name="query" value="{{ $query }}"
                                        id="ul-products-search-field" placeholder="Search Items">
                                    <button type="submit"><i class="flaticon-search-interface-symbol"></i></button>
                                </form>
                            </div>

                            {{-- Categories Widget --}}
                            @if (isset($headerCategories) && $headerCategories->count() > 0)
                                <div class="ul-products-sidebar-widget ul-products-categories">
                                    <h3 class="ul-products-sidebar-widget-title">Categories</h3>
                                    <div class="ul-products-categories-link">
                                        @foreach ($headerCategories as $cat)
                                            <a href="{{ route('public.category.products', $cat->id) }}">
                                                <span>
                                                    <i class="flaticon-arrow-point-to-right"></i> {{ $cat->name }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Main Search Content --}}
                    <div class="col-lg-9 col-md-8">
                        <div class="search-header mb-4">
                            <h2>Results for: "{{ $query }}"</h2>
                            <p class="text-muted">{{ $products->total() }} items found matching your search.</p>
                        </div>

                        <div class="row ul-bs-row row-cols-lg-3 row-cols-2 row-cols-xxs-1">
                            @forelse ($products as $product)
                                <div class="col">
                                    <div class="ul-product">
                                        <div class="ul-product-heading">
                                            <span
                                                class="ul-product-price">${{ number_format($product->retail_price, 2) }}</span>
                                            @if ($product->actual_price > $product->retail_price)
                                                <span class="ul-product-discount-tag">
                                                    {{ round((($product->actual_price - $product->retail_price) / $product->actual_price) * 100) }}%
                                                    Off
                                                </span>
                                            @endif
                                        </div>

                                        <div class="ul-product-img">
                                            @if (Str::startsWith($product->image, 'admin/'))
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}">
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
                                            <h3 class="ul-product-category">
                                                <a href="#">{{ $product->category->name ?? 'Uncategorized' }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <div class="no-results-found">
                                        <i class="flaticon-search-interface-symbol"
                                            style="font-size: 60px; color: #ddd; display: block; margin-bottom: 20px;"></i>
                                        <h3>Oops! No results found.</h3>
                                        <p>Try different keywords or check your spelling.</p>
                                        <a href="{{ route('public.home') }}" class="btn btn-primary mt-3">Continue
                                            Shopping</a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $products->appends(['query' => $query, 'category' => request('category')])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
