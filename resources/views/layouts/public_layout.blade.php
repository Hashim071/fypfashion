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
        <div class="ul-header-top">
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
        </div>

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
                            <form action="#" class="ul-header-search-form">
                                <div class="dropdown-wrapper">
                                    <select name="search-category" id="ul-header-search-category">
                                        <option data-placeholder="true">Select Category</option>
                                        <option value="1">Clothing</option>
                                        <option value="2">Watches</option>
                                        <option value="3">Jewellery</option>
                                        <option value="4">Glasses</option>
                                    </select>
                                </div>
                                <div class="ul-header-search-form-right">
                                    <input type="search" name="header-search" id="ul-header-search"
                                        placeholder="Search Here">
                                    <button type="submit"><span class="icon"><i
                                                class="flaticon-search-interface-symbol"></i></span></button>
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
                    <div class="ul-header-actions">
                        <button class="ul-header-mobile-search-opener d-xxl-none"><i
                                class="flaticon-search-interface-symbol"></i></button>
                        <a href="{{ route('login') }}"><i class="flaticon-user"></i></a>
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
            <div class="ul-footer-top">
                <!-- single links column -->
                <div class="ul-footer-top-widget">
                    <h3 class="ul-footer-top-widget-title">Brands</h3>

                    <div class="ul-footer-top-widget-links">
                        <a href="#">Zara</a>
                        <a href="#">Guess</a>
                        <a href="#">Mango</a>
                        <a href="#">LCWaikiki</a>
                    </div>
                </div>

                <!-- single links column -->
                <div class="ul-footer-top-widget">
                    <h3 class="ul-footer-top-widget-title">Categories</h3>

                    <div class="ul-footer-top-widget-links">
                        <a href="#">Dresses</a>
                        <a href="#">Tops</a>
                        <a href="#">Bottoms</a>
                        <a href="#">Footwear</a>
                    </div>
                </div>

                <!-- single links column -->
                <div class="ul-footer-top-widget">
                    <h3 class="ul-footer-top-widget-title">Services</h3>

                    <div class="ul-footer-top-widget-links">
                        <a href="#">Sale</a>
                        <a href="#">Quick Ship</a>
                        <a href="#">New Designs</a>
                        <a href="#">Protection Plan</a>
                    </div>
                </div>

            </div>

            <!-- single widget -->
            <div class="ul-footer-middle-widget align-self-center">
                <a href="index.html"><img src="{{ asset('admin/assets/images/logo/cutom-logo.png') }}"
                        alt="logo" class="logo"></a>
            </div>
            {{-- </div> --}}

            <div class="ul-footer-bottom">
                <p class="copyright-txt">Copyright 2024 © <a href="https://temptics.com/"
                        class="ul-footer-bottom-link">Goftech</a></p>
                {{-- <img src="assets/img/payment-methods.png" alt="payment methods logos"> --}}
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
