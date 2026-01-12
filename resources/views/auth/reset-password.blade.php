<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Custom Couture</title>
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
            <p class="mb-0">Secure your account with a strong password. Elegant fashion and premium couture await you.
            </p>
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
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer</p>
                        </li>
                        <li class="splide__slide">
                            <p class="ul-header-top-slider-item"><i class="flaticon-sparkle"></i> limited time offer</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Reset Password</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="{{ route('public.home') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Reset Password</span>
                </div>
            </div>
        </div>

        <div class="ul-container">
            <div class="ul-login">
                <div class="ul-inner-page-container">
                    <div class="row justify-content-evenly align-items-center flex-column-reverse flex-md-row">

                        <div class="col-md-5">
                            <div class="ul-login-img text-center">
                                <img src="{{ asset('assets/img/login-img.svg') }}" alt="Reset Password">
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-7">
                            <div class="mb-4">
                                <h3>Create New Password</h3>
                                <p>Apna naya password enter karein aur usay confirm karein.</p>
                            </div>

                            <form action="{{ route('password.update') }}" method="POST" class="ul-contact-form">
                                @csrf
                                {{-- Hidden fields --}}
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="form-group mb-3">
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password" placeholder="New Password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        <i class="fa-solid fa-eye" id="togglePassword"
                                            style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm New Password"
                                            class="form-control">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Update Password</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="ul-footer">
        <div class="ul-inner-container">
            <div class="ul-footer-bottom">
                <p class="copyright-txt">Copyright 2024 © <a href="#" class="ul-footer-bottom-link">Custom
                        Couture</a></p>
                <img src="{{ asset('assets/img/payment-methods.png') }}" alt="payment methods">
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Password Toggle Script --}}
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const confirm_password = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            confirm_password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
