@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    {{-- Toastr Flash Messages --}}
    @if (session('success'))
        <script>toastr.success("{{ session('success') }}");</script>
    @endif
    @if ($errors->any())
         @foreach ($errors->all() as $error)
            <script>toastr.error("{{ $error }}");</script>
        @endforeach
    @endif


    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Manage Returns</span></li>
            </ul>
        </div>
    </div>

    <!-- ✅ SOLUTION 1: Improved Add Return Request Form -->
    <div class="card mb-4">
        <div class="card-header flex-between">
            <h5 class="mb-0">Add New Return Request</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('returns.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Select Order</label>
                        {{-- Replaced manual ID inputs with a dropdown --}}
                        <select name="order_id" class="form-select" required>
                            <option selected disabled>Choose an order...</option>
                            @foreach($ordersForReturn as $order)
                                <option value="{{ $order->id }}">
                                    Order #{{ $order->id }} (Customer: {{ $order->user->name ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" selected>Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                     <div class="col-md-4">
                        <label class="form-label">Return Date</label>
                        <input type="date" class="form-control" name="return_date">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Reason</label>
                        <textarea name="reason" class="form-control" rows="2" placeholder="Enter return reason..."></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-main mt-2">Add Return</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Returns Table -->
    <div class="card overflow-hidden mt-20">
        <div class="card-body p-0 overflow-x-auto">
            <table class="table table-striped align-middle">
                {{-- Table head remains the same --}}
                 <thead>
                    <tr>
                        <th class="h6 text-gray-300">#</th>
                        <th class="h6 text-gray-300">Order</th>
                        <th class="h6 text-gray-300">Customer</th>
                        <th class="h6 text-gray-300">Reason</th>
                        <th class="h6 text-gray-300">Return Date</th>
                        <th class="h6 text-gray-300">Status</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($returns as $return)
                        <tr>
                            <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                            <td><span class="h6 mb-0 fw-medium text-gray-300">#{{ $return->order->id ?? '-' }}</span></td>
                            <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $return->user->name ?? 'Guest' }}</span></td>
                            <td><span class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($return->reason, 30) ?? '-' }}</span></td>
                            <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $return->return_date ? \Carbon\Carbon::parse($return->return_date)->format('d M, Y') : '-' }}</span></td>
                            <td>
                                <span class="badge text-capitalize
                                    @if($return->status == 'pending') bg-warning text-dark
                                    @elseif($return->status == 'approved') bg-success
                                    @elseif($return->status == 'rejected') bg-danger
                                    @endif">
                                    {{ $return->status }}
                                </span>
                            </td>
                            <td class="d-flex gap-2 flex-wrap">
                                <!-- Edit Button -->
                                <button type="button"
                                    class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                    data-bs-toggle="modal" data-bs-target="#editReturnModal{{ $return->id }}">
                                    Edit
                                </button>

                                <!-- ✅ SOLUTION 2: "Update Status" button removed -->

                                <!-- Delete Button -->
                                <button type="button"
                                    class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                    data-bs-toggle="modal" data-bs-target="#deleteReturnModal{{ $return->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal (Now handles everything) -->
                        <div class="modal fade" id="editReturnModal{{ $return->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('returns.update', $return->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Return Request for Order #{{ $return->order_id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label class="form-label">Reason</label>
                                                    <textarea name="reason" class="form-control" rows="3">{{ $return->reason }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Return Date</label>
                                                    <input type="date" name="return_date" class="form-control"
                                                        value="{{ $return->return_date }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="pending" {{ $return->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approved" {{ $return->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="rejected" {{ $return->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-main">Update Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ✅ SOLUTION 2: "Update Status" modal removed -->

                        <!-- Delete Modal (No changes here) -->
                        <div class="modal fade" id="deleteReturnModal{{ $return->id }}" tabindex="-1" aria-hidden="true">
                           <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('returns.destroy', $return->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Return Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete return request for
                                                <strong>Order #{{ $return->order->id ?? '-' }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No return requests found.</td>
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
