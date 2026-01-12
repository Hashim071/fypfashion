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
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">
                            Home
                        </a>
                    </li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Customizations</span></li>
                </ul>
            </div>

            <!-- Add Customization Button -->
            <div class="flex-align gap-8 flex-wrap">
                <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCustomizationModal">
                    Add Customization
                </button>
            </div>
        </div>

        <!-- ✅ Customizations Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Order ID</th>
                            <th class="h6 text-gray-300">Customer</th>
                            <th class="h6 text-gray-300">Product</th>
                            <th class="h6 text-gray-300">Size</th>
                            <th class="h6 text-gray-300">Fabric</th>
                            <th class="h6 text-gray-300">Color</th>
                            <th class="h6 text-gray-300">Style Description</th>
                            <th class="h6 text-gray-300">Delivery Date</th>
                            <th class="h6 text-gray-300">Reference Image</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customizations as $customization)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">#{{ $customization->orderItem->order->id ?? '-' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $customization->orderItem->order->user->name ?? 'Guest' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $customization->orderItem->product->name ?? 'N/A' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->size ?? '-' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->fabric ?? '-' }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $customization->color ?? '-' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($customization->style_description, 25, '...') }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $customization->delivery_date ? \Carbon\Carbon::parse($customization->delivery_date)->format('d M Y') : '-' }}</span>
                                </td>
                                <td>
                                    @if ($customization->reference_image_url)
                                        <a href="{{ asset('storage/' . $customization->reference_image_url) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/' . $customization->reference_image_url) }}"
                                                alt="Design" width="50" class="rounded border">
                                        </a>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCustomizationModal{{ $customization->id }}">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteCustomizationModal{{ $customization->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCustomizationModal{{ $customization->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('customizations.update', $customization->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Customization</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Size</label>
                                                    <select class="form-select" name="size">
                                                        <option value="small"
                                                            @if ($customization->size == 'small') selected @endif>Small</option>
                                                        <option value="medium"
                                                            @if ($customization->size == 'medium') selected @endif>Medium
                                                        </option>
                                                        <option value="large"
                                                            @if ($customization->size == 'large') selected @endif>Large</option>
                                                        <option value="extra-large"
                                                            @if ($customization->size == 'extra-large') selected @endif>Extra Large
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Fabric</label>
                                                    <input type="text" class="form-control" name="fabric"
                                                        value="{{ $customization->fabric }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Color</label>
                                                    <input type="text" class="form-control" name="color"
                                                        value="{{ $customization->color }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Style Description</label>
                                                    <textarea class="form-control" name="style_description" rows="3">{{ $customization->style_description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Delivery Date</label>
                                                    <input type="date" class="form-control" name="delivery_date"
                                                        value="{{ $customization->delivery_date }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Reference Image (Upload new if needed)</label>
                                                    <input type="file" class="form-control" name="reference_image_url"
                                                        accept="image/*">
                                                    @if ($customization->reference_image_url)
                                                        <img src="{{ asset('storage/' . $customization->reference_image_url) }}"
                                                            alt="Design" width="60" class="mt-2 rounded border">
                                                    @endif
                                                </div>
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

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteCustomizationModal{{ $customization->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('customizations.destroy', $customization->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Customization</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete customization for
                                                    <strong>{{ $customization->orderItem->product->name ?? 'this product' }}</strong>?
                                                </p>
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
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No customizations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="card-footer flex-between flex-wrap">
                    {{ $customizations->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customization Modal -->
    <div class="modal fade" id="addCustomizationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customizations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Order Item</label>
                            <select class="form-select" name="order_item_id" required>
                                @foreach (\App\Models\OrderItem::with('product', 'order.user')->get() as $item)
                                    <option value="{{ $item->id }}">
                                        Order #{{ $item->order->id }} - {{ $item->product->name }}
                                        ({{ $item->order->user->name ?? 'Guest' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Size</label>
                            <select class="form-select" name="size">
                                <option selected disabled>Select a size...</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="extra-large">Extra Large</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fabric</label>
                            <input type="text" class="form-control" name="fabric" placeholder="e.g., Cotton">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="color" placeholder="e.g., Navy Blue">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Style Description</label>
                            <textarea class="form-control" name="style_description" rows="3"
                                placeholder="Describe your style preferences..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Delivery Date</label>
                            <input type="date" class="form-control" name="delivery_date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reference Image</label>
                            <input type="file" class="form-control" name="reference_image_url" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-main">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
