@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        {{-- ✅ Toastr Flash Messages --}}
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

        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Blogs</span></li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Add New Blog Post</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Excerpt (Short Description)</label>
                            <textarea class="form-control" name="excerpt" rows="3" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Full Content (Body)</label>
                            <textarea class="form-control" name="body" rows="6" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-main mt-2">Save Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card overflow-hidden mt-20">
            <div class="card-header">
                <h5 class="mb-0">All Blog Posts</h5>
            </div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Image</th>
                            <th class="h6 text-gray-300">Title</th>
                            <th class="h6 text-gray-300">Excerpt</th>
                            <th class="h6 text-gray-300">Published On</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                {{-- ... inside the table body ... --}}
                                <td>
                                    @if (Str::startsWith($blog->image, 'admin/'))
                                        {{-- ✅ Yeh Seeder wali image hai, jo public folder mein hai --}}
                                        <img src="{{ asset($blog->image) }}" width="80" class="rounded">
                                    @else
                                        {{-- ✅ Yeh Form se upload hui image hai, jo storage folder mein hai --}}
                                        <img src="{{ asset('storage/' . $blog->image) }}" width="80" class="rounded">
                                    @endif
                                </td>
                                {{-- ... baqi table ka code ... --}}
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($blog->title, 40) }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($blog->excerpt, 60) }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $blog->published_at->format('d M, Y') }}</span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}">
                                        Edit
                                    </button>
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteBlogModal{{ $blog->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('blogs.update', $blog->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Blog Post</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ $blog->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Excerpt</label>
                                                    <textarea class="form-control" name="excerpt" rows="3" required>{{ $blog->excerpt }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Body</label>
                                                    <textarea class="form-control" name="body" rows="6" required>{{ $blog->body }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/*">
                                                    <img src="{{ asset('storage/' . $blog->image) }}" width="100"
                                                        class="mt-2 rounded">
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

                            <div class="modal fade" id="deleteBlogModal{{ $blog->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Blog Post</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete "<strong>{{ $blog->title }}</strong>"?
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
                                <td colspan="5" class="text-center">No blog posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
