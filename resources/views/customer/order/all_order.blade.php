@extends('layouts.customer_layout') {{-- Or your main app layout --}}

@section('content')
    <div class="dashboard-body">

        {{-- Flash Messages --}}
        @if (session('success'))
            <script> toastr.success("{{ session('success') }}"); </script>
        @endif
        @if (session('error'))
            <script> toastr.error("{{ session('error') }}"); </script>
        @endif

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('customer.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Dashboard</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">My Orders</span></li>
                </ul>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-header"><h4 class="card-title">My Order History</h4></div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Order ID</th>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Total</th>
                            <th class="h6 text-gray-300">Order Status</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">#{{ $order->id }}</span></td>
                                <td><span class="text-gray-300">{{ $order->created_at->format('d M, Y') }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs {{ number_format($order->total, 2) }}</span></td>
                                <td>
                                    <span class="badge {{ get_order_status_class($order->status) }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('customer.orders.show', $order->id) }}"
                                       class="bg-info-50 text-info-600 py-2 px-14 rounded-pill hover-bg-info-600 hover-text-white">
                                        View Details
                                    </a>

                                    {{-- ✅ YAHAN BUTTON ADD KIYA HAI --}}
                                    @if(in_array($order->status, ['confirmed', 'delivered', 'completed']))
                                        <button type="button"
                                            class="bg-success-50 text-success-600 py-2 px-14 rounded-pill hover-bg-success-600 hover-text-white"
                                            data-bs-toggle="modal" data-bs-target="#reviewModal{{ $order->id }}">
                                            Leave a Review
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- ✅ REVIEW MODAL (Har order ke liye alag) -->
                            <div class="modal fade" id="reviewModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('customer.reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Leave a Review for Order #{{ $order->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Product Select Karein -->
                                                <div class="mb-3">
                                                    <label for="product_id_{{ $order->id }}" class="form-label">Which product would you like to review?</label>
                                                    <select name="product_id" id="product_id_{{ $order->id }}" class="form-select" required>
                                                        <option value="">-- Select a product --</option>
                                                        @foreach($order->items as $item)
                                                            <option value="{{ $item->product_id }}">{{ $item->product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Rating Dein -->
                                                <div class="mb-3">
                                                    <label for="rating_{{ $order->id }}" class="form-label">Rating (1 to 5)</label>
                                                    <select name="rating" id="rating_{{ $order->id }}" class="form-select" required>
                                                        <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                                        <option value="4">⭐⭐⭐⭐ (Good)</option>
                                                        <option value="3">⭐⭐⭐ (Average)</option>
                                                        <option value="2">⭐⭐ (Not Good)</option>
                                                        <option value="1">⭐ (Poor)</option>
                                                    </select>
                                                </div>

                                                <!-- Comment Likhein -->
                                                <div class="mb-3">
                                                    <label for="comment_{{ $order->id }}" class="form-label">Your Comment (Optional)</label>
                                                    <textarea name="comment" id="comment_{{ $order->id }}" class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-main">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">You have not placed any orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer flex-between flex-wrap">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    @php
    function get_order_status_class($status) {
        return match ($status) {
            'pending' => 'bg-warning', 'confirmed' => 'bg-primary', 'in_progress' => 'bg-info',
            'shipped' => 'bg-secondary', 'delivered', 'completed' => 'bg-success', 'returned' => 'bg-danger',
            default => 'bg-dark',
        };
    }
    @endphp
@endsection
