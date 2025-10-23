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
                    <li><a href="{{ route('users.index') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Manage Users</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">User Details</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ User Detail Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User Details</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Phone</dt>
                    <dd class="col-sm-9">{{ $user->phone ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Address</dt>
                    <dd class="col-sm-9">{{ $user->address ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Role</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Registered At</dt>
                    <dd class="col-sm-9">{{ $user->created_at->format('d M, Y h:i A') }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('users.index') }}"
                    class="bg-black text-white py-2 px-14 rounded-pill hover-bg-gray-800 hover-text-white">
                    Back
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
