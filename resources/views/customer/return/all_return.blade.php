@extends('layouts.customer_layout') {{-- Use your customer layout --}}

@section('content')
    <div class="dashboard-body">

        {{-- Toastr Flash Messages --}}
        @if (session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error("{{ $error }}");
                </script>
            @endforeach
        @endif

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24">
            <div class="breadcrumb">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('customer.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Dashboard</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">My Returns</span></li>
                </ul>
            </div>
        </div>

        <!-- Create New Return Request Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Request a New Return</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.returns.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Select an Order to Return</label>
                            <select name="order_id" class="form-select" required>
                                <option selected disabled>Choose from your delivered orders...</option>
                                @forelse($eligibleOrders as $order)
                                    <option value="{{ $order->id }}">
                                        Order #{{ $order->id }} (Placed on: {{ $order->created_at->format('d M, Y') }})
                                    </option>
                                @empty
                                    <option disabled>You have no orders eligible for return.</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reason for Return</label>
                            <textarea name="reason" class="form-control" rows="3"
                                placeholder="Please tell us why you want to return this item..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-main mt-2"
                                @if ($eligibleOrders->isEmpty()) disabled @endif>
                                Submit Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Existing Return Requests Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-header">
                <h5 class="mb-0">Your Return History</h5>
            </div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Order ID</th>
                            <th class="h6 text-gray-300">Reason</th>
                            <th class="h6 text-gray-300">Requested On</th>
                            <th class="h6 text-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($returns as $return)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">#{{ $return->order_id }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($return->reason, 50) }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $return->return_date ? \Carbon\Carbon::parse($return->return_date)->format('d M, Y') : '-' }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge text-capitalize
                                    @if ($return->status == 'pending') bg-warning text-dark
                                    @elseif($return->status == 'approved') bg-success
                                    @elseif($return->status == 'rejected') bg-danger @endif">
                                        {{ $return->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">You have not made any return requests yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($returns->hasPages())
                    <div class="card-footer flex-between flex-wrap">
                        {{ $returns->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
