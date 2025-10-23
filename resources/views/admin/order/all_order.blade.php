@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        {{-- ✅ Toastr Flash Messages --}}
        @if (session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
        @endif
        @if (session('error'))
            <script>
                toastr.error("{{ session('error') }}");
            </script>
        @endif

        <!-- ✅ Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Orders</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Orders Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#ID</th>
                            <th class="h6 text-gray-300">Customer</th>
                            <th class="h6 text-gray-300">Total</th>
                            <th class="h6 text-gray-300">Order Status</th>
                            <th class="h6 text-gray-300">Payment Method</th>
                            <th class="h6 text-gray-300">Payment Status</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">#{{ $order->id }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $order->user->name ?? 'Guest' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs
                                        {{ number_format($order->total, 2) }}</span></td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'confirmed') bg-primary
                                    @elseif($order->status == 'in_progress') bg-info
                                    @elseif($order->status == 'shipped') bg-secondary
                                    @elseif($order->status == 'delivered' || $order->status == 'completed') bg-success
                                    @elseif($order->status == 'returned') bg-danger
                                    @else bg-dark @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>

                                <!-- ✅ Payment Method -->
                                <td>
                                    <span
                                        class="badge
                                    {{ $order->payment_method == 'cod' ? 'bg-primary' : 'bg-info' }}">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>

                                <!-- ✅ Payment Status -->
                                <td>
                                    <span
                                        class="badge
                                    @if ($order->payment_status == 'unpaid') bg-warning
                                    @elseif($order->payment_status == 'paid') bg-success
                                    @elseif($order->payment_status == 'partial') bg-info
                                    @elseif($order->payment_status == 'failed') bg-danger
                                    @else bg-dark @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>

                                <!-- ✅ Actions -->
                                <td class="d-flex gap-2 flex-wrap">
                                    <!-- 🔹 View Order -->
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="bg-info-50 text-info-600 py-2 px-14 rounded-pill hover-bg-info-600 hover-text-white">
                                        View
                                    </a>

                                    <!-- 🔹 Edit Order -->
                                    <button type="button"
                                        class="bg-primary-50 text-primary-600 py-2 px-14 rounded-pill hover-bg-primary-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">
                                        Edit
                                    </button>

                                    <!-- 🔹 Update Status -->
                                    <button type="button"
                                        class="bg-warning-50 text-warning-700 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $order->id }}">
                                        Status
                                    </button>

                                    <!-- 🔹 Update Payment -->
                                    <button type="button"
                                        class="bg-success-50 text-success-600 py-2 px-14 rounded-pill hover-bg-success-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#updatePaymentModal{{ $order->id }}">
                                        Payment
                                    </button>

                                    <!-- 🔹 Invoice -->
                                    <a href="{{ route('orders.invoice', $order->id) }}"
                                        class="bg-secondary-50 text-secondary-600 py-2 px-14 rounded-pill hover-bg-secondary-600 hover-text-white">
                                        Invoice
                                    </a>

                                    <!-- 🔹 Delete -->
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteOrderModal{{ $order->id }}">
                                        Delete
                                    </button>

                                </td>

                            </tr>

                            <!-- 🔹 Update Order Status Modal -->
                            <div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Order Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <select class="form-select" name="status" required>
                                                    @foreach (['pending', 'confirmed', 'in_progress', 'shipped', 'delivered', 'completed', 'returned'] as $status)
                                                        <option value="{{ $status }}"
                                                            {{ $order->status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-main">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- 🔹 Update Payment Status Modal -->
                            <div class="modal fade" id="updatePaymentModal{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('orders.updatePaymentStatus', $order->id) }}"
                                            method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label">Payment Method</label>
                                                <select name="payment_method" class="form-select mb-3" required>
                                                    <option value="cod"
                                                        {{ $order->payment_method == 'cod' ? 'selected' : '' }}>Cash on
                                                        Delivery</option>
                                                    <option value="payfast"
                                                        {{ $order->payment_method == 'payfast' ? 'selected' : '' }}>PayFast
                                                    </option>
                                                </select>

                                                <label class="form-label">Payment Status</label>
                                                <select name="payment_status" class="form-select" required>
                                                    @foreach (['unpaid', 'paid', 'partial', 'failed'] as $status)
                                                        <option value="{{ $status }}"
                                                            {{ $order->payment_status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Update Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- 🔹 Delete Modal -->
                            <div class="modal fade" id="deleteOrderModal{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Order</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete order #{{ $order->id }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Order #{{ $order->id }}</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="total" class="form-label">Total Amount</label>
                                                    <input type="number" class="form-control" id="total"
                                                        name="total" value="{{ $order->total }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="delivery_address" class="form-label">Delivery
                                                        Address</label>
                                                    <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required>{{ $order->delivery_address }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="payment_method" class="form-label">Payment Method</label>
                                                    <select class="form-select" id="payment_method" name="payment_method"
                                                        required>
                                                        <option value="cod"
                                                            @if ($order->payment_method == 'cod') selected @endif>
                                                            Cash on Delivery (COD)
                                                        </option>
                                                        <option value="payfast"
                                                            @if ($order->payment_method == 'payfast') selected @endif>
                                                            Payfast
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update Order</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No orders found.</td>
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
@endsection
