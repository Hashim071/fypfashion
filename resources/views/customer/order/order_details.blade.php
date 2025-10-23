@extends('layouts.customer_layout')
@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('customer.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Dashboard</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('customer.orders.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">My Orders</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Order #{{ $order->id }}</span></li>
                </ul>
            </div>
            <div class="buttons">
                <a href="{{ route('customer.orders.invoice', $order->id) }}" class="btn btn-main">
                    <i class="ph ph-download-simple me-2"></i> Download Invoice
                </a>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="card mb-4">
            <div class="card-header flex-between">
                <h5 class="mb-0">Order Details</h5>
                <span><strong>Placed on:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</span>
            </div>
            <div class="card-body">
                <p class="text-gray-300"><strong>Shipping Address:</strong> {{ $order->delivery_address ?? '-' }}</p>
                <p class="text-gray-300"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p class="text-gray-300"><strong>Order Status:</strong>
                    <span class="badge {{ get_order_status_class($order->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </p>
                <p class="text-gray-300"><strong>Payment Status:</strong>
                     <span class="badge {{ get_payment_status_class($order->payment_status) }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
                <p class="text-gray-300"><strong>Total Amount:</strong> Rs {{ number_format($order->total, 2) }}</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card overflow-hidden mt-20">
            <div class="card-header">
                <h5 class="mb-0">Items in this Order</h5>
            </div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Product</th>
                            <th class="h6 text-gray-300">Quantity</th>
                            <th class="h6 text-gray-300">Price</th>
                            <th class="h6 text-gray-300">Customization</th>
                            <th class="h6 text-gray-300">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $item->product->name ?? 'N/A' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $item->quantity }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs {{ number_format($item->price, 2) }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">
                                    @if ($item->customization)
                                        <small>
                                            Size: {{ $item->customization->size ?? '-' }}<br>
                                            Color: {{ $item->customization->color ?? '-' }}
                                        </small>
                                    @else
                                        -
                                    @endif
                                </span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs {{ number_format($item->subtotal, 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Helper functions for badge classes --}}
    @php
    function get_order_status_class($status) {
        return match ($status) {
            'pending' => 'bg-warning',
            'confirmed' => 'bg-primary',
            'in_progress' => 'bg-info',
            'shipped' => 'bg-secondary',
            'delivered', 'completed' => 'bg-success',
            'returned' => 'bg-danger',
            default => 'bg-dark',
        };
    }

    function get_payment_status_class($status) {
        return match ($status) {
            'unpaid' => 'bg-warning',
            'paid' => 'bg-success',
            'partial' => 'bg-info',
            'failed' => 'bg-danger',
            default => 'bg-dark',
        };
    }
    @endphp
@endsection
