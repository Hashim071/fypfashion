@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        {{-- ✅ Toastr Flash Messages --}}
        @if (session('success'))
            <script>toastr.success("{{ session('success') }}");</script>
        @endif
        @if (session('error'))
            <script>toastr.error("{{ session('error') }}");</script>
        @endif

        <!-- ✅ Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                           class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Cart</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Cart Items Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">User</th>
                            <th class="h6 text-gray-300">Product</th>
                            <th class="h6 text-gray-300">Quantity</th>
                            <th class="h6 text-gray-300">Price</th>
                            <th class="h6 text-gray-300">Total</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $cart)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $cart->user->name ?? 'Guest' }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $cart->product->name ?? 'N/A' }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $cart->quantity }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs {{ number_format($cart->price, 2) }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs {{ number_format($cart->price * $cart->quantity, 2) }}</span></td>
                                <td>
                                    <!-- Delete -->
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteCartModal{{ $cart->id }}">
                                        Remove
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteCartModal{{ $cart->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Remove Cart Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to remove <strong>{{ $cart->product->name ?? 'this item' }}</strong> from cart?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No items in cart.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="card-footer flex-between flex-wrap">
                    {{ $cartItems->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
