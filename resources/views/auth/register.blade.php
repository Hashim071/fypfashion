<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Custom Couture - Fashion Store')</title>
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/cutom-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/icon/flaticon_glamer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/splide/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slim-select/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-wow/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <div class="ul-sidebar">
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="index.html">
                    <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" class="logo">
                </a>
            </div>
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>
        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>
        <div class="ul-sidebar-about d-none d-lg-block">
            <span class="title">About glamer</span>
            <p class="mb-0">Phasellus eget fermentum mauris. Suspendisse nec dignissim nulla. Integer non quam
                commodo, scelerisque felis id, eleifend turpis. Phasellus in nulla quis erat tempor tristique eget vel
                purus. Nulla pharetra pharetra pharetra. Praesent varius eget justo ut lacinia. Phasellus pharetra,
                velit viverra lacinia consequat, ipsum odio mollis dolor, nec facilisis arcu arcu ultricies sapien.</p>
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
                <h2 class="ul-breadcrumb-title">Register</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="index.html"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Register</span>
                </div>
            </div>
        </div>
        <div class="ul-container">
            <div class="ul-login">
                <div class="ul-inner-page-container">
                    <div class="row justify-content-evenly align-items-center flex-column-reverse flex-md-row">
                        <div class="col-md-5">
                            <div class="ul-login-img text-center">
                                <img src="{{ asset('assets/img/login-img.svg') }}" alt="Register Image">
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

                            <form action="{{ route('register') }}" method="POST" class="ul-contact-form">
                                @csrf

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <div class="position-relative">
                                            <input type="text" name="name" id="name"
                                                placeholder="Enter Your Name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror" required>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="position-relative">
                                            <input type="email" name="email" id="email"
                                                placeholder="Enter Email Address" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" required>
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="position-relative">
                                            <input type="password" name="password" id="password"
                                                placeholder="Enter Password"
                                                class="form-control @error('password') is-invalid @enderror" required>

                                            {{-- Pehle field ke liye Eye icon --}}
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
                                                id="password_confirmation" placeholder="Confirm Password"
                                                class="form-control" required>

                                            {{-- Doosre field ke liye Eye icon --}}
                                            <i class="fa-solid fa-eye" id="togglePasswordConfirm"
                                                style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>

                            <div class="text-center mt-3">
                                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
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
                <p class="copyright-txt">Copyright 2024 © <a href="https://temptics.com/"
                        class="ul-footer-bottom-link">Custom Couture</a></p>
                <img src="{{ asset('assets/img/payment-methods.png') }}" alt="payment methods logos">
            </div>
        </div>
    </footer>
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

    <script>
        // Pehle Password Field ke liye
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // password input ki type ko toggle karein
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // eye icon ko toggle karein
            this.classList.toggle('fa-eye-slash');
        });


        // Confirm Password Field ke liye
        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePasswordConfirm.addEventListener('click', function(e) {
            // password input ki type ko toggle karein
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);

            // eye icon ko toggle karein
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
