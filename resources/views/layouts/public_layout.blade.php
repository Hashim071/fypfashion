<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Custom Couture')</title>

    <!-- Libraries CSS -->
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_glamer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/cutom-logo.png') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>


<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- SIDEBAR SECTION START -->
    <div class="ul-sidebar">
        <!-- header -->
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="index.html">
                    {{-- <img src="assets/img/logo.svg" alt="logo" class="logo"> --}}
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>

        <div class="ul-sidebar-about d-none d-lg-block">
            <span class="title">About Custom Couture</span>
            <p class="mb-0">
                We understand that being particular about your clothes means you know what you like.
                "Custom Couture" was created to solve the common struggle of explaining your vision to a
                tailor and getting something that doesn't match what you had in mind.
            </p>
            <p class="mb-0 mt-2">
                Our platform makes dress designing easier and more fun. You can
                choose from a wide variety of styles, fabrics, and colors to create a unique outfit, or shop our stylish
                prêt-à-porter (ready-to-wear) collection for modern and affordable dresses.
                Do it all from the comfort of your home, with no more back-and-forth trips or
                miscommunications.
            </p>
        </div>


        <!-- sidebar footer -->
        <div class="ul-sidebar-footer">
            <span class="ul-sidebar-footer-title">Follow us</span>

            <div class="ul-sidebar-footer-social">
                <a href="#"><i class="flaticon-facebook-app-symbol"></i></a>
                <a href="#"><i class="flaticon-twitter"></i></a>
                <a href="#"><i class="flaticon-instagram"></i></a>
                <a href="#"><i class="flaticon-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- SIDEBAR SECTION END -->


    <!-- HEADER SECTION START -->
    <header class="ul-header">
        <!-- header top -->
        {{-- <div class="ul-header-top">
            <div class="ul-header-top-slider splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}


        <!-- header bottom -->
        <div class="ul-header-bottom">
            <div class="ul-container">
                <div class="ul-header-bottom-wrapper">
                    <!-- header left -->
                    <div class="header-bottom-left">
                        <div class="logo-container">
                            <a href="{{ url('/') }}" class="d-inline-block">
                                <img src="{{ asset('admin/assets/images/logo/cutom-logo.png') }}" alt="logo"
                                    class="logo">
                            </a>

                        </div>

                        <!-- search form -->
                        <div class="ul-header-search-form-wrapper flex-grow-1 flex-shrink-0">
                            <form action="{{ route('public.search') }}" method="GET" class="ul-header-search-form">
                                <div class="dropdown-wrapper">
                                    <select name="category" id="ul-header-search-category">
                                        <option value="">All Categories</option>
                                        @foreach ($headerCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ul-header-search-form-right">
                                    <input type="search" name="query" id="ul-header-search" placeholder="Search Here"
                                        required>
                                    <button type="submit">
                                        <span class="icon"><i class="flaticon-search-interface-symbol"></i></span>
                                    </button>
                                </div>
                            </form>

                            <button class="ul-header-mobile-search-closer d-xxl-none"><i
                                    class="flaticon-close"></i></button>
                        </div>
                    </div>

                    <!-- header nav -->
                    <div class="ul-header-nav-wrapper">
                        <div class="to-go-to-sidebar-in-mobile">
                            <nav class="ul-header-nav">
                                <a href="{{ route('public.home') }}">Home</a>
                                <a href="{{ route('public.contact') }}">Contact Us</a>
                                <a href="{{ route('public.blog') }}">Blog</a>
                            </nav>
                        </div>
                    </div>

                    <!-- actions -->
                    <div class="ul-header-actions" style="display: flex; align-items: center; gap: 15px;">
                        <button class="ul-header-mobile-search-opener d-xxl-none">
                            <i class="flaticon-search-interface-symbol"></i>
                        </button>

                        @auth
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard') }}"
                                style="text-decoration: none; display: flex; align-items: center;">
                                <div
                                    style="
                position: relative;
                width: 44px;
                height: 44px;
                padding: 2.5px;
                border-radius: 50%;
                background: conic-gradient(#ea4335 0% 25%, #4285f4 25% 50%, #34a853 50% 75%, #fbbc05 75% 100%);
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                                    <div
                                        style="
                    width: 100%;
                    height: 100%;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: #9c27b0;
                    color: white;
                    font-weight: 600;
                    font-size: 18px;
                    border: 2px solid white;
                    font-family: Arial, sans-serif;
                ">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('login') }}" style="text-decoration: none; color: inherit; font-size: 24px;">
                                <i class="flaticon-user"></i>
                            </a>
                        @endauth
                    </div>
                    <!-- sidebar opener -->
                    <div class="d-inline-flex">
                        <button class="ul-header-sidebar-opener"><i class="flaticon-hamburger"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER SECTION END -->

    @yield('content')

    <!-- FOOTER SECTION START -->
    <footer class="ul-footer">
        <div class="ul-inner-container">
            <div class="ul-footer-bottom">
                <p class="copyright-txt">Copyright 2024 © <a href="https://temptics.com/"
                        class="ul-footer-bottom-link">Custom Couture</a></p>
                <img src="{{ asset('assets/img/payment-methods.png') }}" alt="payment methods logos">
            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END -->

    <!-- Libraries JS -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>

</body>

</html>
