<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>@yield('title', 'Custom Couture Admin Panel')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/cutom-logo.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- File Upload -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/file-upload.css') }}">

    <!-- Plyr -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plyr.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <!-- Full Calendar -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/full-calendar.css') }}">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery-ui.css') }}">

    <!-- Quill Editor -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/editor-quill.css') }}">

    <!-- Apex Charts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/apexcharts.css') }}">

    <!-- Calendar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/calendar.css') }}">

    <!-- Jvector Map -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery-jvectormap-2.0.5.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}">


</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->

    <aside class="sidebar">
        <!-- sidebar close btn -->
        <button type="button"
            class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i
                class="ph ph-x"></i></button>
        <!-- sidebar close btn -->

        <a href="index.html"
            class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            {{-- <img src="{{ asset('admin/assets/images/logo/cutom-logo-removebg-preview.png') }}" alt="Logo"> --}}
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    <!-- Dashboard -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-squares-four"></i></span>
                            <span class="text">Admin Dashboard</span>
                        </a>
                    </li>

                    <!-- Categories  -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('categories.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-stack"></i></span>
                            <span class="text">All Categories</span>
                        </a>
                    </li>

                    <!-- Products-->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('products.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-shopping-bag"></i></span>
                            <span class="text">Products</span>
                        </a>
                    </li>

                    <!-- Orders-->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('orders.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-shopping-cart-simple"></i></span>
                            <span class="text">All Orders</span>
                        </a>
                    </li>

                    <!-- Returns -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('returns.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-arrow-counter-clockwise"></i></span>
                            <span class="text">Return</span>
                        </a>
                    </li>

                    <!-- Cart (Customer Only) -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('cart.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-shopping-cart"></i></span>
                            <span class="text">Cart</span>
                        </a>
                    </li>

                    <!-- Reviews -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('reviews.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-star"></i></span>
                            <span class="text">All Reviews</span>
                        </a>
                    </li>

                    <!-- Customization -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('customizations.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-scissors"></i></span>
                            <span class="text">Customization</span>
                        </a>
                    </li>

                    <!-- Transactions -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('transactions.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-currency-dollar"></i></span>
                            <span class="text">All Transactions</span>
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('users.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users"></i></span>
                            <span class="text">All Users</span>
                        </a>
                    </li>

                    <!-- Contact -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.contact.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-phone"></i></span>
                            <span class="text">Contact</span>
                        </a>
                    </li>

                    <!-- Blog -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('blogs.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-article"></i></span>
                            <span class="text">Blog</span>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.settings.index') }}" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-gear"></i></span>
                            <span class="text">Admin Settings</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </aside>
    <!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">
        <div class="top-navbar flex-between gap-16">

            <div class="flex-align gap-16">

                @auth
                    <h5 class="mb-0 text-uppercase d-none d-sm-block"
                        style="font-size: 18px; font-weight: 800; color: #333; letter-spacing: 1px;">
                        WELCOME {{ Auth::user()->name }}!
                    </h5>
                @endauth
                <!-- Toggle Button Start -->
                <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i
                        class="ph ph-list"></i></button>
                <!-- Toggle Button End -->
            </div>

            <div class="flex-align gap-16">

                {{-- Home Screen --}}
                <div class="dropdown">
                    <a href="{{ url('/') }}"
                        class="dropdown-btn w-40 h-40 transition-2 rounded-circle text-2xl flex-center"
                        style="background-color: #eef2ff; color: #4f46e5; border: 1.5px solid #e0e7ff;"
                        type="button">
                        <span class="position-relative">
                            <i class="ph-fill ph-house"></i>
                        </span>
                    </a>
                </div>

                <!-- User Profile Start -->
                <div class="dropdown">
                    <button
                        class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <img src="{{ asset('admin/assets/images/logo/dummy-image.png') }}" alt="Image"
                                class="h-32 w-32 rounded-circle">
                            <span
                                class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                                    <img src="{{ asset('admin/assets/images/logo/dummy-image.png') }}" alt="Profile"
                                        class="w-54 h-54 rounded-circle object-cover">
                                    <div>
                                        <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                        <p class="fw-medium text-13 text-gray-200">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">

                                    <li class="pt-8 border-top border-gray-100">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                            <span class="text-2xl text-danger-600 d-flex"><i
                                                    class="ph ph-sign-out"></i></span>
                                            <span class="text">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Profile Start -->
            </div>
        </div>

        @yield('content')


        <div class="dashboard-footer">
            <div class="flex-between flex-wrap gap-16">
                <p class="text-gray-300 text-13 fw-normal"> &copy; Copyright Edmate 2024, All Right Reserverd</p>
                <div class="flex-align flex-wrap gap-16">
                    <a href="#"
                        class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">License</a>
                    <a href="#"
                        class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">More
                        Themes</a>
                    <a href="#"
                        class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Documentation</a>
                    <a href="#"
                        class="text-gray-300 text-13 fw-normal hover-text-main-600 hover-text-decoration-underline">Support</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery js -->
    <script src="{{ asset('admin/assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Phosphor Js -->
    <script src="{{ asset('admin/assets/js/phosphor-icon.js') }}"></script>

    <!-- File Upload -->
    <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script>

    <!-- Plyr -->
    <script src="{{ asset('admin/assets/js/plyr.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- Full Calendar -->
    <script src="{{ asset('admin/assets/js/full-calendar.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('admin/assets/js/jquery-ui.js') }}"></script>

    <!-- Quill Editor -->
    <script src="{{ asset('admin/assets/js/editor-quill.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('admin/assets/js/apexcharts.min.js') }}"></script>

    <!-- Calendar Js -->
    <script src="{{ asset('admin/assets/js/calendar.js') }}"></script>

    <!-- Jvector Map -->
    <script src="{{ asset('admin/assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
