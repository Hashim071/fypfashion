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
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error("{{ $error }}");
                </script>
            @endforeach
        @endif

        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Products</span></li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Add New Product</h5>
            </div>
            <div class="card-body">
                <form id="addProductForm" action="{{ route('products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        {{-- Basic Product Details --}}
                        <div class="col-md-4"><label class="form-label">Code</label><input type="text"
                                class="form-control" name="code" value="{{ old('code') }}" required></div>
                        <div class="col-md-4"><label class="form-label">Name</label><input type="text"
                                class="form-control" name="name" value="{{ old('name') }}" required></div>
                        <div class="col-md-4"><label class="form-label">Category</label><select name="category_id"
                                class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12"><label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter product description...">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-3"><label class="form-label">Retail Price</label><input type="number"
                                step="0.01" class="form-control" name="retail_price" value="{{ old('retail_price') }}"
                                required></div>
                        <div class="col-md-3"><label class="form-label">Actual Price</label><input type="number"
                                step="0.01" class="form-control" name="actual_price" value="{{ old('actual_price') }}"
                                required></div>
                        <div class="col-md-2"><label class="form-label">Quantity</label><input type="number"
                                class="form-control" name="quantity" value="{{ old('quantity') }}" required></div>
                        <div class="col-md-2"><label class="form-label">Status</label><select name="status"
                                class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select></div>
                        <div class="col-md-2"><label class="form-label">Action</label><select name="action"
                                class="form-control">
                                <option value="available">Available</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select></div>
                        <div class="col-md-4"><label class="form-label">Image</label><input type="file"
                                class="form-control" name="image"></div>

                        {{-- Is Customizable Toggle --}}
                        <div class="col-md-3">
                            <label class="form-label">Customizable?</label>
                            <select name="is_customizable" class="form-control is-customizable-toggle">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                    </div>

                    {{-- 👇👇 CUSTOMIZATION FIELDS SECTION 👇👇 --}}
                    <div class="customization-fields-container mt-4 border-top pt-3" style="display: none;">
                        <h5>Customization Fields</h5>
                        <div class="fields-wrapper">
                            {{-- Fields will be added here by JS --}}
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2 add-field-btn">Add Field</button>
                    </div>
                    {{-- 👆👆 END OF CUSTOMIZATION SECTION 👆👆 --}}

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-main mt-3">Save Product</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="card overflow-hidden mt-20">
            {{-- ... Aapka table ka baaqi structure wese hi rahega ... --}}
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">ID</th>
                            <th class="h6 text-gray-300">Code</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Category</th>
                            <th class="h6 text-gray-300">Price</th>
                            <th class="h6 text-gray-300">Stock</th>
                            <th class="h6 text-gray-300">Status</th>
                            <th class="h6 text-gray-300">Customizable</th>
                            <th class="h6 text-gray-300">Image</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $product->id }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $product->code }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $product->name }}</span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $product->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($product->retail_price, 2) }}
                                    </span>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $product->quantity }}</td>
                                <td><span
                                        class="badge bg-{{ $product->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($product->status) }}</span>
                                </td>
                                <td>
                                    @if ($product->is_customizable)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->image)
                                        @if (Str::startsWith($product->image, 'admin/'))
                                            {{-- ✅ Yeh Seeder wali image hai, jo public folder mein hai --}}
                                            <img src="{{ asset($product->image) }}" width="50" height="50"
                                                class="rounded">
                                        @else
                                            {{-- ✅ Yeh Form se upload hui image hai, jo storage folder mein hai --}}
                                            <img src="{{ asset('storage/' . $product->image) }}" width="50"
                                                height="50" class="rounded">
                                        @endif
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2 flex-wrap">
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProductModal{{ $product->id }}">Edit</button>
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl"> {{-- Modal size ko xl kar diya hai --}}
                                    <div class="modal-content">
                                        <form class="edit-product-form"
                                            action="{{ route('products.update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Product</h5><button type="button"
                                                    class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    {{-- Basic Details --}}
                                                    <div class="col-md-6"><label class="form-label">Code</label><input
                                                            type="text" name="code" class="form-control"
                                                            value="{{ $product->code }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Name</label><input
                                                            type="text" name="name" class="form-control"
                                                            value="{{ $product->name }}" required></div>
                                                    <div class="col-md-12"><label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                                                    </div>
                                                    <div class="col-md-6"><label
                                                            class="form-label">Category</label><select name="category_id"
                                                            class="form-control">
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    @selected($product->category_id == $cat->id)>{{ $cat->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6"><label class="form-label">Retail
                                                            Price</label><input type="number" step="0.01"
                                                            name="retail_price" class="form-control"
                                                            value="{{ $product->retail_price }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Actual
                                                            Price</label><input type="number" step="0.01"
                                                            name="actual_price" class="form-control"
                                                            value="{{ $product->actual_price }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Quantity</label><input
                                                            type="number" name="quantity" class="form-control"
                                                            value="{{ $product->quantity }}" required></div>
                                                    <div class="col-md-4"><label class="form-label">Status</label><select
                                                            name="status" class="form-control">
                                                            <option value="active" @selected($product->status == 'active')>Active
                                                            </option>
                                                            <option value="inactive" @selected($product->status == 'inactive')>Inactive
                                                            </option>
                                                        </select></div>

                                                    <div class="col-md-4">
                                                        <label class="form-label">Customizable?</label>
                                                        <select name="is_customizable"
                                                            class="form-control is-customizable-toggle">
                                                            <option value="0" @selected(!$product->is_customizable)>No</option>
                                                            <option value="1" @selected($product->is_customizable)>Yes
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4"><label class="form-label">Image</label><input
                                                            type="file" name="image" class="form-control">
                                                        @if ($product->image)
                                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                                width="80" class="mt-2 rounded">
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- ✅✅ EDIT MODAL CUSTOMIZATION FIELDS (FIXED LAYOUT) ✅✅ --}}
                                                <div class="customization-fields-container mt-4 border-top pt-3"
                                                    style="{{ $product->is_customizable ? '' : 'display: none;' }}">
                                                    <h5>Customization Fields</h5>
                                                    <div class="fields-wrapper">
                                                        @if ($product->is_customizable && is_array($product->customization_fields))
                                                            @foreach ($product->customization_fields as $index => $field)
                                                                <div class="row g-2 align-items-center field-row mb-2">
                                                                    <div class="col"><input type="text"
                                                                            name="customization_fields[{{ $index }}][label]"
                                                                            class="form-control" placeholder="Field Label"
                                                                            value="{{ $field['label'] ?? '' }}" required>
                                                                    </div>
                                                                    <div class="col"><input type="text"
                                                                            name="customization_fields[{{ $index }}][name]"
                                                                            class="form-control"
                                                                            placeholder="Field Name (no space)"
                                                                            value="{{ $field['name'] ?? '' }}" required>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <select
                                                                            name="customization_fields[{{ $index }}][type]"
                                                                            class="form-control field-type-select">
                                                                            <option value="text"
                                                                                @selected(($field['type'] ?? '') == 'text')>Text</option>
                                                                            <option value="textarea"
                                                                                @selected(($field['type'] ?? '') == 'textarea')>Textarea
                                                                            </option>
                                                                            <option value="select"
                                                                                @selected(($field['type'] ?? '') == 'select')>Select</option>
                                                                            <option value="file"
                                                                                @selected(($field['type'] ?? '') == 'file')>File</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col options-input-wrapper"
                                                                        style="{{ ($field['type'] ?? '') == 'select' ? 'display:block;' : 'display:none;' }}">
                                                                        <input type="text"
                                                                            name="customization_fields[{{ $index }}][options]"
                                                                            class="form-control"
                                                                            placeholder="Options (comma-separated)"
                                                                            value="{{ is_array($field['options'] ?? null) ? implode(',', $field['options']) : '' }}">
                                                                    </div>
                                                                    <div class="col-auto"><button type="button"
                                                                            class="btn btn-sm btn-danger remove-field-btn">&times;</button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-primary mt-2 add-field-btn">Add
                                                        Field</button>
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

                            <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1"
                                aria-hidden="true">
                                {{-- ... Delete Modal wese hi rahega ... --}}
                            </div>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer flex-between flex-wrap">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- 👇👇 JAVASCRIPT FOR DYNAMIC FIELDS (IMPROVED) 👇👇 --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Function to handle showing/hiding the whole customization block
            function handleCustomizationToggle(form) {
                const toggle = form.querySelector('.is-customizable-toggle');
                const fieldsContainer = form.querySelector('.customization-fields-container');
                if (toggle && fieldsContainer) {
                    fieldsContainer.style.display = toggle.value === '1' ? 'block' : 'none';
                }
            }

            // Function to create a new field row HTML
            function createFieldRow(index) {
                return `
            <div class="row g-2 align-items-center field-row mb-2">
                <div class="col"><input type="text" name="customization_fields[${index}][label]" class="form-control" placeholder="Field Label" required></div>
                <div class="col"><input type="text" name="customization_fields[${index}][name]" class="form-control" placeholder="Field Name (no space)" required></div>
                <div class="col-md-2">
                    <select name="customization_fields[${index}][type]" class="form-control field-type-select">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="select">Select</option>
                        <option value="file">File</option>
                    </select>
                </div>
                <div class="col options-input-wrapper" style="display: none;">
                    <input type="text" name="customization_fields[${index}][options]" class="form-control" placeholder="Options (comma-separated)">
                </div>
                <div class="col-auto"><button type="button" class="btn btn-sm btn-danger remove-field-btn">&times;</button></div>
            </div>
        `;
            }

            // Initialize all forms on the page
            document.querySelectorAll('#addProductForm, .edit-product-form').forEach(form => {
                handleCustomizationToggle(form); // Initial check

                form.querySelector('.is-customizable-toggle').addEventListener('change', () =>
                    handleCustomizationToggle(form));

                form.querySelector('.add-field-btn').addEventListener('click', function() {
                    const wrapper = form.querySelector('.fields-wrapper');
                    const newIndex = wrapper.children.length; // Simple count of children
                    wrapper.insertAdjacentHTML('beforeend', createFieldRow(newIndex));
                });
            });

            // Event Delegation for dynamic elements (remove button and type select)
            document.querySelector('.dashboard-body').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-field-btn')) {
                    e.target.closest('.field-row').remove();
                }
            });

            document.querySelector('.dashboard-body').addEventListener('change', function(e) {
                if (e.target.classList.contains('field-type-select')) {
                    const row = e.target.closest('.field-row');
                    const optionsWrapper = row.querySelector('.options-input-wrapper');
                    optionsWrapper.style.display = e.target.value === 'select' ? 'block' : 'none';
                }
            });
        });
    </script>
@endsection
