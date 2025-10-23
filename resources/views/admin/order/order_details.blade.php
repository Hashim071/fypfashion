@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- ✅ Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('orders.index') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Orders</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Order #{{ $order->id }}</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Order Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Order Details</h5>
            </div>
            <div class="card-body">
                <p class="text-gray-300"><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                <p class="text-gray-300"><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
                <p class="text-gray-300"><strong>Address:</strong> {{ $order->delivery_address ?? '-' }}</p>
                <p class="text-gray-300"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p class="text-gray-300"><strong>Order Status:</strong>
                    <span
                        class="badge
                    @if ($order->status == 'pending') bg-warning
                    @elseif($order->status == 'confirmed') bg-primary
                    @elseif($order->status == 'in_progress') bg-info
                    @elseif($order->status == 'shipped') bg-secondary
                    @elseif(in_array($order->status, ['delivered', 'completed'])) bg-success
                    @elseif($order->status == 'returned') bg-danger
                    @else bg-dark @endif">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </p>

                <p class="text-gray-300"><strong>Payment Status:</strong>
                    <span
                        class="badge
                    @if ($order->payment_status == 'unpaid') bg-warning
                    @elseif($order->payment_status == 'paid') bg-success
                    @elseif($order->payment_status == 'partial') bg-info
                    @elseif($order->payment_status == 'failed') bg-danger
                    @else bg-dark @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>

                    <!-- ✅ Update Payment Modal Trigger -->
                    <button type="button"
                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                        data-bs-toggle="modal" data-bs-target="#updatePaymentModal">
                        Update
                    </button>
                </p>

                <p class="text-gray-300"><strong>Total:</strong> Rs {{ number_format($order->total, 2) }}</p>
                <p class="text-gray-300"><strong>Placed on:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>

        <!-- ✅ Order Items -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Product</th>
                            <th class="h6 text-gray-300">Quantity</th>
                            <th class="h6 text-gray-300">Price</th>
                            <th class="h6 text-gray-300">Subtotal</th>
                            <th class="h6 text-gray-300">Size</th>
                            <th class="h6 text-gray-300">Fabric</th>
                            <th class="h6 text-gray-300">Color</th>
                            <th class="h6 text-gray-300">Reference Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $item->product->name ?? 'N/A' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $item->quantity }}</td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs
                                        {{ number_format($item->price, 2) }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs
                                        {{ number_format($item->subtotal, 2) }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $item->customization->size ?? '-' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $item->customization->fabric ?? '-' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $item->customization->color ?? '-' }}</span>
                                </td>
                                <td>
                                    @if ($item->customization && $item->customization->reference_image_url)
                                        <a href="{{ asset('storage/' . $item->customization->reference_image_url) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/' . $item->customization->reference_image_url) }}"
                                                alt="Design" width="50" class="rounded">
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ✅ Review -->
        @if ($order->review)
            <div class="card mt-20">
                <div class="card-header">
                    <h5 class="text-gray-300">Customer Review</h5>
                </div>
                <div class="card-body">
                    <p><span class="h6 mb-0 fw-medium text-gray-300"><strong>Rating:</strong>
                            {{ $order->review->rating }}/5</span></p>
                    <p><span class="h6 mb-0 fw-medium text-gray-300"><strong>Comment:</strong>
                            {{ $order->review->comment ?? 'No comment provided.' }}</span></p>
                </div>
            </div>
        @endif

        <!-- ✅ Return -->
        @if ($order->returnRequest)
            <div class="card mt-20">
                <div class="card-header">
                    <h5 class="text-gray-300">Return Request</h5>
                </div>
                <div class="card-body">
                    <p><span class="h6 mb-0 fw-medium text-gray-300"><strong>Status:</strong>
                            {{ ucfirst($order->returnRequest->status) }}</span></p>
                    <p><span class="h6 mb-0 fw-medium text-gray-300"><strong>Reason:</strong>
                            {{ $order->returnRequest->reason ?? '-' }}</span></p>
                </div>
            </div>
        @endif

        <!-- 🔹 Update Payment Modal -->
        <div class="modal fade" id="updatePaymentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('orders.updatePaymentStatus', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Update Payment Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select mb-3" name="payment_method" required>
                                <option value="cod" {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Cash on
                                    Delivery</option>
                                <option value="payfast" {{ $order->payment_method == 'payfast' ? 'selected' : '' }}>PayFast
                                </option>
                            </select>

                            <label class="form-label">Payment Status</label>
                            <select class="form-select" name="payment_status" required>
                                @foreach (['unpaid', 'paid', 'partial', 'failed'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $order->payment_status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
