@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        {{-- ✅ Toastr Flash Messages --}}
        @if (session('message'))
            <script>
                var type = "{{ session('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info("{{ session('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ session('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ session('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ session('message') }}");
                        break;
                }
            </script>
        @endif


        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Manage Settings</span></li>
                </ul>
            </div>
        </div>

        <div class="card overflow-hidden mt-20">
            <div class="card-header">
                <h4 class="card-title">Update Your Settings</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $setting->name ?? '' }}" placeholder="Enter your full name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ $setting->email ?? '' }}" placeholder="Enter your email">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone"
                                value="{{ $setting->phone ?? '' }}" placeholder="Enter your phone number">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password</label>

                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password"
                                    autocomplete="new-password" placeholder="Enter new password (optional)">

                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="ph ph-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            <small class="text-muted">Leave blank if you don't want to change the password.</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter your full address">{{ $setting->address ?? '' }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');
            const icon = document.querySelector('#togglePasswordIcon');

            togglePassword.addEventListener('click', function(e) {
                // input ka type badlein (password se text ya text se password)
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Icon ko badlein (eye se eye-slash ya ulta)
                if (type === 'text') {
                    icon.classList.remove('ph-eye');
                    icon.classList.add('ph-eye-slash');
                } else {
                    icon.classList.remove('ph-eye-slash');
                    icon.classList.add('ph-eye');
                }
            });
        });
    </script>
@endsection
