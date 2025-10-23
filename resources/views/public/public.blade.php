@extends('layouts.public_layout')
@section('content')
    <main>
        <!-- BANNER SECTION START -->
        <div class="overflow-hidden">
            <div class="ul-container">
                <section class="ul-banner">
                    <div class="ul-banner-slider-wrapper">
                        <div class="ul-banner-slider swiper">
                            <div class="swiper-wrapper">
                                <!-- single slide -->
                                <div class="swiper-slide ul-banner-slide">
                                    <div class="ul-banner-slide-img">
                                        <img src="{{ asset('assets/img/home11.jpg') }}" alt="Banner Image">
                                    </div>
                                    <div class="ul-banner-slide-txt">
                                        <span class="ul-banner-slide-sub-title">Perfect for Summer Evenings</span>
                                        <h1 class="ul-banner-slide-title">Casual and Stylish for All Seasons</h1>
                                        <p class="ul-banner-slide-price">Starting From <span class="price">$129</span></p>
                                        <a href="shop.html" class="ul-btn">SHOP NOW <i
                                                class="flaticon-up-right-arrow"></i></a>
                                    </div>
                                </div>

                                <!-- single slide -->
                                <div class="swiper-slide ul-banner-slide ul-banner-slide--2">
                                    <div class="ul-banner-slide-img">
                                        <img src="{{ asset('assets/img/home4.jpg') }}" alt="Banner Image">
                                    </div>
                                    <div class="ul-banner-slide-txt">
                                        <span class="ul-banner-slide-sub-title">Perfect for Summer Evenings</span>
                                        <h1 class="ul-banner-slide-title">Casual and Stylish for All Seasons</h1>
                                        <p class="ul-banner-slide-price">Starting From <span class="price">$129</span></p>
                                        <a href="shop.html" class="ul-btn">SHOP NOW <i
                                                class="flaticon-up-right-arrow"></i></a>
                                    </div>
                                </div>

                                <!-- single slide -->
                                <div class="swiper-slide ul-banner-slide ul-banner-slide--3">
                                    <div class="ul-banner-slide-img">
                                        <img src="{{ asset('assets/img/home22.jpg') }}" alt="Banner Image">
                                    </div>
                                    <div class="ul-banner-slide-txt">
                                        <span class="ul-banner-slide-sub-title">Perfect for Summer Evenings</span>
                                        <h1 class="ul-banner-slide-title">Casual and Stylish for All Seasons</h1>
                                        <p class="ul-banner-slide-price">Starting From <span class="price">$129</span></p>
                                        <a href="shop.html" class="ul-btn">SHOP NOW <i
                                                class="flaticon-up-right-arrow"></i></a>
                                    </div>
                                </div>

                            </div>

                            <!-- slider navigation -->
                            <div class="ul-banner-slider-nav-wrapper">
                                <div class="ul-banner-slider-nav">
                                    <button class="prev"><span class="icon"><i
                                                class="flaticon-down"></i></span></button>
                                    <button class="next"><span class="icon"><i
                                                class="flaticon-down"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ul-banner-img-slider-wrapper">
                        <div class="ul-banner-img-slider swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="assets/img/home33.jpg" alt="Banner Image">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/img/home2.jpg" alt="Banner Image">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/img/home3.jpg" alt="Banner Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- BANNER SECTION END -->

        <!-- CATEGORY SECTION START -->
        <div class="ul-container">
            <section class="ul-categories">
                <div class="ul-inner-container">
                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
                        @foreach ($categories as $category)
                            <div class="col">
                                <a class="ul-category" href="{{ route('category.show', $category->id) }}">
                                    <div class="ul-category-img">
                                        @if (Str::startsWith($category->image, 'admin/'))
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                        @else
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->name }}">
                                        @endif
                                    </div>
                                    <div class="ul-category-txt">
                                        <span>{{ $category->name }}</span>
                                    </div>
                                    <div class="ul-category-btn">
                                        <span><i class="flaticon-arrow-point-to-right"></i></span>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
        <!-- CATEGORY SECTION END -->

        <!-- FLASH SALE SECTION START -->
        <div class="overflow-hidden">
            <div class="ul-container">
                <div class="ul-flash-sale">
                    <div class="ul-inner-container">
                        <div class="ul-section-heading ul-flash-sale-heading">
                            <div class="left">
                                <span class="ul-section-sub-title">New Collection</span>
                                <h2 class="ul-section-title">Customizable Products</h2>
                            </div>
                            {{-- Countdown timer (agar zaroorat ho to rakhein) --}}
                            <div class="ul-flash-sale-countdown-wrapper">
                                <div class="ul-flash-sale-countdown">
                                    {{-- Countdown logic yahan add karein agar zaroori hai --}}
                                </div>
                            </div>
                            <a href="shop.html" class="ul-btn">View All Collection <i
                                    class="flaticon-up-right-arrow"></i></a>
                        </div>

                        <div class="ul-flash-sale-slider swiper">
                            <div class="swiper-wrapper">

                                {{-- Loop through customizable products --}}
                                @forelse ($customizableProducts as $product)
                                    <div class="swiper-slide">
                                        <div class="ul-product">
                                            <div class="ul-product-heading">
                                                <span
                                                    class="ul-product-price">${{ number_format($product->retail_price, 2) }}</span>

                                                {{-- Calculate and display discount percentage --}}
                                                @if ($product->actual_price > $product->retail_price)
                                                    @php
                                                        $discount =
                                                            (($product->actual_price - $product->retail_price) /
                                                                $product->actual_price) *
                                                            100;
                                                    @endphp
                                                    <span class="ul-product-discount-tag">{{ round($discount) }}%
                                                        Off</span>
                                                @endif
                                            </div>

                                            <div class="ul-product-img">
                                                {{-- Pehle check karein ke product ki image mojood hai ya nahi --}}
                                                @if ($product->image)
                                                    {{-- Ab check karein ke path 'admin/' se shuru hota hai (seeder image) --}}
                                                    @if (Str::startsWith($product->image, 'admin/'))
                                                        {{-- Yeh Seeder wali image hai, is liye direct public path use karein --}}
                                                        <img src="{{ asset($product->image) }}"
                                                            alt="{{ $product->name }}">
                                                    @else
                                                        {{-- Yeh upload hui image hai, is liye 'storage/' wala path use karein --}}
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name }}">
                                                    @endif
                                                @else
                                                    {{-- Agar koi image nahi hai to placeholder dikhayein --}}
                                                    <img src="{{ asset('path/to/your/default-image.png') }}"
                                                        alt="No Image Available">
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
                                                <h4 class="ul-product-title"><a href="#">{{ $product->name }}</a>
                                                </h4>
                                                {{-- Assuming you have a category relationship on your Product model --}}
                                                <h5 class="ul-product-category"><a
                                                        href="#">{{ $product->category->name ?? 'Uncategorized' }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {{-- Yeh message show hoga agar koi customizable product nahi milta --}}
                                    <div class="swiper-slide">
                                        <p>No customizable products found at the moment.</p>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FLASH SALE SECTION END -->


        <!-- MOST SELLING START -->
        <div class="ul-container">
            <section class="ul-products ul-most-selling-products">
                <div class="ul-inner-container">
                    <div class="ul-section-heading flex-lg-row flex-column text-md-start text-center">
                        <div class="left">
                            <span class="ul-section-sub-title">most selling items</span>
                            <h2 class="ul-section-title">Top Products This Week</h2>
                        </div>

                        <div class="right">
                            <div class="ul-most-sell-filter-navs">
                                <button type="button" data-filter="all">All Products</button>
                                <button type="button" data-filter=".best-selling">Best Selling</button>
                                <button type="button" data-filter=".on-selling">On Sale</button>
                                <button type="button" data-filter=".top-rating">Top Rated</button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="ul-bs-row row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 ul-filter-products-wrapper">

                        @forelse ($allSectionProducts as $product)
                            @php
                                // Determine the filter class for the product
                                $filterClass = '';
                                if ($topSellingProducts->contains($product)) {
                                    $filterClass .= ' best-selling';
                                }
                                if ($onSaleProducts->contains($product)) {
                                    $filterClass .= ' on-selling';
                                }
                                if ($topRatedProducts->contains($product)) {
                                    $filterClass .= ' top-rating';
                                }
                            @endphp

                            <div class="mix col{{ $filterClass }}">
                                <div class="ul-product-horizontal">

                                    {{-- ✅ INLINE STYLE YAHAN ADD KIYA GAYA HAI --}}
                                    <div class="ul-product-horizontal-img"
                                        style="width: 120px; height: 120px; flex-shrink: 0; overflow: hidden;">

                                        @if ($product->image)
                                            @if (Str::startsWith($product->image, 'admin/'))
                                                {{-- ✅ INLINE STYLE YAHAN BHI ADD KIYA GAYA HAI --}}
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                            @else
                                                {{-- ✅ INLINE STYLE YAHAN BHI ADD KIYA GAYA HAI --}}
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                            @endif
                                        @else
                                            {{-- Placeholder image ke liye bhi style add karein --}}
                                            <img src="{{ asset('path/to/default-image.png') }}" alt="No Image"
                                                style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                        @endif
                                    </div>

                                    <div class="ul-product-horizontal-txt">
                                        <span
                                            class="ul-product-price">${{ number_format($product->retail_price, 2) }}</span>
                                        <h4 class="ul-product-title"><a
                                                href="{{ route('public.product.details', $product->id) }}">{{ $product->name }}</a>
                                        </h4>
                                        <h5 class="ul-product-category"><a
                                                href="{{ route('public.product.details', $product->id) }}">{{ $product->category->name ?? '' }}</a>
                                        </h5>
                                        <div class="ul-product-rating">
                                            <span class="star"><i class="flaticon-star"></i></span>
                                            <span class="star"><i class="flaticon-star"></i></span>
                                            <span class="star"><i class="flaticon-star"></i></span>
                                            <span class="star"><i class="flaticon-star"></i></span>
                                            <span class="star"><i class="flaticon-star"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col">
                                <p>No products to display in this section yet.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </section>
        </div>
        <!-- MOST SELLING END -->


        <!-- REVIEWS SECTION START -->
        <section class="ul-reviews overflow-hidden">
            <div class="ul-section-heading text-center justify-content-center">
                <div>
                    <span class="ul-section-sub-title">Testimonials</span>
                    <h2 class="ul-section-title">What Our Clients Say</h2>
                    <p class="ul-reviews-heading-descr">Hear from those who have experienced the art of bespoke fashion and
                        personalized style.
                    </p>
                </div>
            </div>

            <div class="ul-reviews-slider swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                            </div>
                            <p class="ul-review-descr">The wedding gown they created was a dream come true. The attention
                                to detail was flawless, and it fit perfectly. I felt like a princess on my big day. Thank
                                you, Custom Couture!</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img
                                            src="{{ asset('admin/assets/images/logo/female_dummy.png') }}"
                                            alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Aisha Khan</h3>
                                        <span class="reviewer-role">Bride-to-be</span>
                                    </div>
                                </div>

                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star-3"></i>
                            </div>
                            <p class="ul-review-descr">I needed a power suit for an important business event, and they
                                delivered perfection. The craftsmanship is top-notch, and the fit gives me so much
                                confidence.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img
                                            src="{{ asset('admin/assets/images/logo/david-chen.png') }}"
                                            alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">David Chen</h3>
                                        <span class="reviewer-role">Corporate Executive</span>
                                    </div>
                                </div>

                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                            </div>
                            <p class="ul-review-descr">From the design consultation to the final fitting, the entire
                                experience was wonderful. My evening gown for the gala was stunning and I received endless
                                compliments all night!</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img
                                            src="{{ asset('admin/assets/images/logo/fatima.png') }}"
                                            alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">Fatima Ali</h3>
                                        <span class="reviewer-role">Gala Attendee</span>
                                    </div>
                                </div>

                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                            </div>
                            <p class="ul-review-descr">The quality of the fabric and the precision of the tailoring are
                                unmatched. This is true artistry. My bespoke jacket is now my favorite piece in my wardrobe.
                                Worth every penny.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img
                                            src="{{ asset('admin/assets/images/logo/john-doe.webp') }}"
                                            alt="reviewer image"></div>
                                    <div>
                                        <h3 class="reviewer-name">John Doe</h3>
                                        <span class="reviewer-role">Fashion Enthusiast</span>
                                    </div>
                                </div>

                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="ul-review">
                            <div class="ul-review-rating">
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                                <i class="flaticon-star"></i>
                            </div>
                            <p class="ul-review-descr">The quality of the fabric and the precision of the tailoring are
                                unmatched. This is true artistry. My bespoke jacket is now my favorite piece in my wardrobe.
                                Worth every penny.</p>
                            <div class="ul-review-bottom">
                                <div class="ul-review-reviewer">
                                    <div class="reviewer-image"><img
                                            src="{{ asset('admin/assets/images/logo/izhan.png') }}" alt="reviewer image">
                                    </div>
                                    <div>
                                        <h3 class="reviewer-name">Izhan Ali</h3>
                                        <span class="reviewer-role">Fashion Enthusiast</span>
                                    </div>
                                </div>

                                <div class="ul-review-icon"><i class="flaticon-left"></i></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- REVIEWS SECTION END -->

        <!-- GALLERY SECTION START -->
        <div class="ul-gallery overflow-hidden mx-auto">
            <div class="ul-gallery-slider swiper">
                <div class="swiper-wrapper">
                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-2.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-2.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-3.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-3.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-4.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-4.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-5.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-5.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-2.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-2.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-3.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-3.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-4.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-4.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- single gallery item -->
                    <div class="ul-gallery-item swiper-slide">
                        <img src="{{ asset('admin/assets/images/logo/gallery-item-5.jpg') }}" alt="Gallery Image">
                        <div class="ul-gallery-item-btn-wrapper">
                            <a href="{{ asset('admin/assets/images/logo/gallery-item-5.jpg') }}"
                                data-fslightbox="gallery">
                                <i class="flaticon-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- GALLERY SECTION END -->
    </main>
@endsection
