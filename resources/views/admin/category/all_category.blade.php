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
                    <li><span class="text-main-600 fw-normal text-15">Manage Categories</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Add Category Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Add New Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-main mt-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ✅ Categories Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">ID</th>
                            <th class="h6 text-gray-300">Image</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Description</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $category->id }}</span></td>
                                <td>
                                    @if ($category->image)
                                        @if (Str::startsWith($category->image, 'admin/'))
                                            {{-- ✅ Yeh Seeder wali image hai, jo public folder mein hai --}}
                                            <img src="{{ asset($category->image) }}" width="50" class="rounded">
                                        @else
                                            {{-- ✅ Yeh Form se upload hui image hai, jo storage folder mein hai --}}
                                            <img src="{{ asset('storage/' . $category->image) }}" width="50"
                                                class="rounded">
                                        @endif
                                    @else
                                        <img src="{{ asset('images/default-category.png') }}" width="50"
                                            class="rounded">
                                    @endif
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $category->name }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $category->description }}</span></td>
                                <td>
                                    <!-- Edit -->
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                        Edit
                                    </button>
                                    <!-- Delete -->
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $category->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                        value="{{ $category->description }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/*">
                                                    @if ($category->image)
                                                        <img src="{{ asset('storage/' . $category->image) }}"
                                                            width="70" class="mt-2 rounded">
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
                            <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Category</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <strong>{{ $category->name }}</strong>?
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
                                <td colspan="5" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer flex-between flex-wrap">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
