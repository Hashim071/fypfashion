@extends('layouts.admin_layout')
@section('content')
    <div class="dashboard-body">

        <div class="row gy-4">
            <div class="col-lg-12">
                <!-- Widgets Start -->
                <div class="row gx-3 gy-4">

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">${{ number_format($totalRevenue, 2) }}</h4>
                                <span class="text-gray-600">Total Revenue</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-success-600 text-white text-2xl">
                                        <i class="ph-fill ph-currency-dollar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $pendingOrders }}</h4>
                                <span class="text-gray-600">Pending Orders</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                        <i class="ph-fill ph-clock-countdown"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $totalCustomers }}</h4>
                                <span class="text-gray-600">Total Customers</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-info-600 text-white text-2xl">
                                        <i class="ph-fill ph-users"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $totalProducts }}</h4>
                                <span class="text-gray-600">Total Products</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-primary-600 text-white text-2xl">
                                        <i class="ph-fill ph-package"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $customOrdersCount }}</h4>
                                <span class="text-gray-600">Custom Orders</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-scissors"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $pendingReturns }}</h4>
                                <span class="text-gray-600">Pending Returns</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-danger-600 text-white text-2xl">
                                        <i class="ph-fill ph-arrow-u-left-top"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Widgets End -->


                <!-- Top Course Start -->
                {{-- <div class="card mt-24">
                    <div class="card-body">
                        <div class="mb-20 flex-between flex-wrap gap-8">
                            <h4 class="mb-0">Study Statistics</h4>
                            <div class="flex-align gap-16 flex-wrap">
                                <div class="flex-align flex-wrap gap-16">
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-600"></span>
                                        <span class="text-13 text-gray-600">Study</span>
                                    </div>
                                    <div class="flex-align flex-wrap gap-8">
                                        <span class="w-8 h-8 rounded-circle bg-main-two-600"></span>
                                        <span class="text-13 text-gray-600">Test</span>
                                    </div>
                                </div>
                                <select class="form-select form-control text-13 px-8 pe-24 py-8 rounded-8 w-auto">
                                    <option value="1">Yearly</option>
                                    <option value="1">Monthly</option>
                                    <option value="1">Weekly</option>
                                    <option value="1">Today</option>
                                </select>
                            </div>
                        </div>

                        <div id="doubleLineChart" class="tooltip-style y-value-left"></div>

                    </div>
                </div> --}}
                <!-- Top Course End -->

            </div>
        </div>
    </div>
@endsection
