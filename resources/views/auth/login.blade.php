<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Page ka title dynamically set karne ke liye. Aap controller se $title bhej sakte hain. --}}
    <title>@yield('title', 'Custom Couture - Fashion Store')</title>
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/cutom-logo.png') }}">

    <!-- libraries CSS -->
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_glamer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">

    {{-- CDN links ko asset() helper ki zaroorat nahi hoti --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- custom CSS -->
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
                    <img src="assets/img/logo.svg" alt="logo" class="logo">
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>

        <div class="ul-sidebar-about d-none d-lg-block">
            <span class="title">About glamer</span>
            <p class="mb-0">Phasellus eget fermentum mauris. Suspendisse nec dignissim nulla. Integer non quam
                commodo, scelerisque felis id, eleifend turpis. Phasellus in nulla quis erat tempor tristique eget vel
                purus. Nulla pharetra pharetra pharetra. Praesent varius eget justo ut lacinia. Phasellus pharetra,
                velit viverra lacinia consequat, ipsum odio mollis dolor, nec facilisis arcu arcu ultricies sapien.
                Quisque ut dapibus nunc. Vivamus sit amet efficitur velit. Phasellus eget fermentum mauris. Suspendisse
                nec dignissim nulla. Integer non quam commodo, scelerisque felis id, eleifend turpis. Phasellus in nulla
                quis erat tempor tristique eget vel purus. Nulla pharetra pharetra pharetra. Praesent varius eget justo
                ut lacinia. Phasellus pharetra velit.</p>
        </div>


        <!-- product slider -->
        <div class="ul-sidebar-products-wrapper d-none d-lg-flex">
            <div class="ul-sidebar-products-slider swiper">
                <div class="swiper-wrapper">
                    <!-- product card -->
                    <div class="swiper-slide">
                        <div class="ul-product">
                            <div class="ul-product-heading">
                                <span class="ul-product-price">$99.00</span>
                                <span class="ul-product-discount-tag">25% Off</span>
                            </div>

                            <div class="ul-product-img">
                                <img src="assets/img/product-img-1.jpg" alt="Product Image">

                                <div class="ul-product-actions">
                                    <button><i class="flaticon-shopping-bag"></i></button>
                                    <a href="#"><i class="flaticon-hide"></i></a>
                                    <button><i class="flaticon-heart"></i></button>
                                </div>
                            </div>

                            <div class="ul-product-txt">
                                <h4 class="ul-product-title"><a href="shop-details.html">Orange Airsuit</a></h4>
                                <h5 class="ul-product-category"><a href="shop.html">Fashion Bag</a></h5>
                            </div>
                        </div>
                    </div>

                    <!-- product card -->
                    <div class="swiper-slide">
                        <div class="ul-product">
                            <div class="ul-product-heading">
                                <span class="ul-product-price">$99.00</span>
                                <span class="ul-product-discount-tag">25% Off</span>
                            </div>

                            <div class="ul-product-img">
                                <img src="assets/img/product-img-2.jpg" alt="Product Image">

                                <div class="ul-product-actions">
                                    <button><i class="flaticon-shopping-bag"></i></button>
                                    <a href="#"><i class="flaticon-hide"></i></a>
                                    <button><i class="flaticon-heart"></i></button>
                                </div>
                            </div>

                            <div class="ul-product-txt">
                                <h4 class="ul-product-title"><a href="shop-details.html">Orange Airsuit</a></h4>
                                <h5 class="ul-product-category"><a href="shop.html">Fashion Bag</a></h5>
                            </div>
                        </div>
                    </div>

                    <!-- product card -->
                    <div class="swiper-slide">
                        <div class="ul-product">
                            <div class="ul-product-heading">
                                <span class="ul-product-price">$99.00</span>
                                <span class="ul-product-discount-tag">25% Off</span>
                            </div>

                            <div class="ul-product-img">
                                <img src="assets/img/product-img-2.jpg" alt="Product Image">

                                <div class="ul-product-actions">
                                    <button><i class="flaticon-shopping-bag"></i></button>
                                    <a href="#"><i class="flaticon-hide"></i></a>
                                    <button><i class="flaticon-heart"></i></button>
                                </div>
                            </div>

                            <div class="ul-product-txt">
                                <h4 class="ul-product-title"><a href="shop-details.html">Orange Airsuit</a></h4>
                                <h5 class="ul-product-category"><a href="shop.html">Fashion Bag</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ul-sidebar-products-slider-nav flex-shrink-0">
                <button class="prev"><i class="flaticon-left-arrow"></i></button>
                <button class="next"><i class="flaticon-arrow-point-to-right"></i></button>
            </div>
        </div>

        <div class="ul-sidebar-about d-none d-lg-block">
            <p class="mb-0">Phasellus eget fermentum mauris. Suspendisse nec dignissim nulla. Integer non quam
                commodo, scelerisque felis id, eleifend turpis. Phasellus in nulla quis erat tempor tristique eget vel
                purus. Nulla pharetra pharetra pharetra. Praesent varius eget justo ut lacinia. Phasellus pharetra,
                velit viverra lacinia consequat, ipsum odio mollis dolor, nec facilisis arcu arcu ultricies sapien.
                Quisque ut dapibus nunc. Vivamus sit amet efficitur velit. Phasellus eget fermentum mauris. Suspendisse
                nec dignissim nulla. Integer non quam commodo, scelerisque felis id, eleifend turpis. Phasellus in nulla
                quis erat tempor tristique eget vel purus. Nulla pharetra pharetra pharetra. Praesent varius eget justo
                ut lacinia. Phasellus pharetra velit.</p>
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

    </header>
    <!-- HEADER SECTION END -->

    <main>
        <!-- BREADCRUMB SECTION START -->
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Log In</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="index.html"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Log In</span>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB SECTION END -->


        <div class="ul-container">
            <div class="ul-login">
                <div class="ul-inner-page-container">
                    <div class="row justify-content-evenly align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-5">
                            <div class="ul-login-img text-center">
                                <img src="{{ asset('assets/img/login-img.svg') }}" alt="Login Image">
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-7">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('login.attempt') }}" method="POST" class="ul-contact-form">
                                @csrf

                                <div class="row">
                                    <!-- email -->
                                    <div class="form-group mb-3">
                                        <div class="position-relative">
                                            <input type="email" name="email" id="email"
                                                placeholder="Enter Email Address" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- password -->
                                    <div class="form-group mb-3">
                                        <div class="position-relative">
                                            <input type="password" name="password" id="password"
                                                placeholder="Enter Password"
                                                class="form-control @error('password') is-invalid @enderror">

                                            {{-- Eye icon add karein --}}
                                            <i class="fa-solid fa-eye" id="togglePassword"
                                                style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>

                                <!-- submit btn -->
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </form>

                            <div class="text-center mt-3">
                                <p>Not have an account? <a href="{{ route('register') }}">Signup here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- libraries JS -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide-extension-auto-scroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slim-select/slimselect.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/animate-wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splittype/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mixitup/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fslightbox/fslightbox.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- Password Toggle Script Yahan Add Karein --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // password input ki type ko toggle karein
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // eye icon ko toggle karein
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
