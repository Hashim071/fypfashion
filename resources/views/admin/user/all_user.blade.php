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
                    <li><span class="text-main-600 fw-normal text-15">Manage Users</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Users Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">ID</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Email</th>
                            <th class="h6 text-gray-300">Phone</th>
                            <th class="h6 text-gray-300">Address</th>
                            <th class="h6 text-gray-300">Role</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $user->id }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $user->name }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $user->email }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $user->phone ?? 'N/A' }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $user->address ?? 'N/A' }}</span></td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <!-- View -->
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                        View
                                    </a>
                                    <!-- Delete -->
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
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
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer flex-between flex-wrap">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
