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
                    <li><span class="text-main-600 fw-normal text-15">All Transactions</span></li>
                </ul>
            </div>
        </div>

        <!-- ✅ Transactions Table -->
        <div class="card overflow-hidden mt-20">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Order ID</th>
                            <th class="h6 text-gray-300">Customer</th>
                            <th class="h6 text-gray-300">Transaction ID</th>
                            <th class="h6 text-gray-300">Amount</th>
                            <th class="h6 text-gray-300">Status</th>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">#{{ $transaction->order->id ?? 'N/A' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $transaction->order->user->name ?? 'Guest' }}</span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $transaction->transaction_id ?? 'N/A' }}
                                    </span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">Rs
                                        {{ number_format($transaction->amount, 2) }}</span></td>
                                <td>
                                    <span
                                        class="badge
                                    @if ($transaction->status == 'success') bg-success
                                    @else bg-danger @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $transaction->created_at->format('d M, Y h:i A') }}</span>
                                </td>
                                <td>
                                    <a href=""
                                        class="bg-info-50 text-info-600 py-2 px-14 rounded-pill hover-bg-info-600 hover-text-white">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-300">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="card-footer flex-between flex-wrap">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
