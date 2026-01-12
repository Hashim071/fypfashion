@extends('layouts.customer_layout')
@section('content')
    <div class="dashboard-body">
        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="row gx-4 gy-4">

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $totalOrders }}</h4>
                                <span class="text-gray-600">Total Orders</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                        <i class="ph-fill ph-clock-countdown"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
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


                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $completedOrders }}</h4>
                                <span class="text-gray-600">Completed Orders</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                        <i class="ph-fill ph-check-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">{{ $customOrders }}</h4>
                                <span class="text-gray-600">My Custom Orders</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                        <i class="ph-fill ph-scissors"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Rs {{ number_format($totalSpent, 2) }}</h4>
                                <span class="text-gray-600">Total Investment in Style</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl">
                                        <i class="ph-fill ph-scissors"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
