@extends('layouts.customer_layout') {{-- Use your customer layout --}}

@section('content')
    <div class="dashboard-body">

        {{-- Breadcrumb --}}
        <div class="breadcrumb-with-buttons mb-24">
            <div class="breadcrumb">
                <ul class="flex-align gap-4">
                    <li>
                        <a href="{{ route('customer.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">
                            Dashboard
                        </a>
                    </li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">My Customizations</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My Customization Requests</h4>
            </div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Order ID</th>
                            <th class="h6 text-gray-300">Product</th>
                            <th class="h6 text-gray-300">Size</th>
                            <th class="h6 text-gray-300">Fabric</th>
                            <th class="h6 text-gray-300">Color</th>
                            <th class="h6 text-gray-300">Reference Image</th>
                            <th class="h6 text-gray-300">Requested Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customizations as $customization)
                            <tr>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">#{{ $customization->orderItem->order->id ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->orderItem->product->name ?? 'Product not found' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300 text-capitalize">{{ $customization->size ?? '-' }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->fabric ?? '-' }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->color ?? '-' }}</span></td>
                                <td>
                                    @if ($customization->reference_image_url)
                                        <a href="{{ asset('storage/' . $customization->reference_image_url) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $customization->reference_image_url) }}" alt="Reference" width="50" class="rounded border">
                                        </a>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{ $customization->delivery_date ? \Carbon\Carbon::parse($customization->delivery_date)->format('d M, Y') : '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">You have not made any customization requests yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($customizations->hasPages())
                    <div class="card-footer flex-between flex-wrap">
                        {{ $customizations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
