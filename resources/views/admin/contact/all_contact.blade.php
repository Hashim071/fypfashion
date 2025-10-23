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

        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Contact Messages</span></li>
                </ul>
            </div>
        </div>

        <div class="card overflow-hidden mt-20">
            <div class="card-header">
                <h5 class="mb-0">All Contact Messages</h5>
            </div>
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">ID</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Email</th>
                            <th class="h6 text-gray-300">Phone</th>
                            <th class="h6 text-gray-300">Message</th>
                            <th class="h6 text-gray-300">Received At</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->id }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->first_name }}
                                        {{ $contact->last_name }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->email }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $contact->phone_number ?? 'N/A' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ Str::limit($contact->message, 50) }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $contact->created_at->format('d M, Y h:i A') }}</span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#deleteContactModal{{ $contact->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteContactModal{{ $contact->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the message from
                                                    <strong>{{ $contact->first_name }}
                                                        {{ $contact->last_name }}</strong>?
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
                                <td colspan="7" class="text-center">No messages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
