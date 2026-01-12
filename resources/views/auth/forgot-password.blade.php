<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - Custom Couture</title>
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/cutom-logo.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_glamer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <div class="ul-sidebar">
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="/">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" class="logo">
                </a>
            </div>
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>
        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>
        <div class="ul-sidebar-about d-none d-lg-block">
            <span class="title">About Custom Couture</span>
            <p class="mb-0">Your premium fashion destination for custom designs and elegant couture.</p>
        </div>
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

    <header class="ul-header">
        <div class="ul-header-top">
            <div class="ul-header-top-slider splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide"><p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer</p></li>
                        <li class="splide__slide"><p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Forgot Password</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Forgot Password</span>
                </div>
            </div>
        </div>

        <div class="ul-container">
            <div class="ul-login">
                <div class="ul-inner-page-container">
                    <div class="row justify-content-evenly align-items-center flex-column-reverse flex-md-row">

                        <div class="col-md-5">
                            <div class="ul-login-img text-center">
                                <img src="{{ asset('assets/img/login-img.svg') }}" alt="Forgot Password">
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-7">
                            <div class="mb-4">
                                <h3>Forgot Password?</h3>
                                <p>Koi baat nahi! Apna registered email likhein, hum aapko reset link bhej denge.</p>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('password.email') }}" method="POST" class="ul-contact-form">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="position-relative">
                                        <input type="email" name="email" id="email"
                                            placeholder="Enter Registered Email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                            </form>

                            <div class="text-center mt-3">
                                <p>Back to <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="ul-footer">
        <div class="ul-inner-container">
            <div class="ul-footer-bottom">
                <p class="copyright-txt">Copyright 2024 © <a href="#" class="ul-footer-bottom-link">Custom Couture</a></p>
                <img src="{{ asset('assets/img/payment-methods.png') }}" alt="payment methods">
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
