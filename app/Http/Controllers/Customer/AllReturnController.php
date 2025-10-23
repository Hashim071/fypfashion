<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ReturnRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AllReturnController extends Controller
{
    /**
     * Display the authenticated user's return requests and a form to create a new one.
     */
    public function index()
    {
        $userId = Auth::id();

        // Get all existing return requests for the current user
        $returns = ReturnRequest::where('user_id', $userId)
            ->with('order')
            ->latest()
            ->paginate(10);

        // Get orders that are eligible for a return request
        // (e.g., status is 'delivered' and it doesn't already have a return request)
        $eligibleOrders = Order::where('user_id', $userId)
            ->where('status', 'delivered') // Or whatever status you consider returnable
            ->whereDoesntHave('returnRequest')
            ->get();

        return view('customer.return.all_return', compact('returns', 'eligibleOrders'));
    }

    /**
     * Store a new return request from the customer.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            // Ensure the selected order exists and belongs to the current user
            'order_id' => [
                'required',
                Rule::exists('orders', 'id')->where('user_id', $userId),
                'unique:return_requests,order_id' // Prevent multiple return requests for the same order
            ],
            'reason' => 'required|string|max:1000',
        ]);

        ReturnRequest::create([
            'order_id'    => $request->order_id,
            'user_id'     => $userId,
            'reason'      => $request->reason,
            'status'      => 'pending', // Default status for new requests is always pending
            'return_date' => now(),
        ]);

        return redirect()
            ->route('customer.returns.index')
            ->with('success', '✅ Your return request has been submitted successfully.');
    }
}
