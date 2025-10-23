<?php

namespace App\Http\Controllers\Admin\Return;

use App\Http\Controllers\Controller;
use App\Models\ReturnRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnRequest::with(['order', 'user'])
            ->latest()
            ->paginate(10);

        // ✅ SOLUTION 1: Get orders that don't have a return request yet for the dropdown
        $ordersForReturn = Order::whereDoesntHave('returnRequest')
            ->with('user')
            ->get();

        return view('admin.return.all_return', compact('returns', 'ordersForReturn'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // ✅ SOLUTION 1: Validate only order_id
            'order_id'    => 'required|exists:orders,id|unique:return_requests,order_id',
            'reason'      => 'nullable|string|max:1000',
            'status'      => 'required|in:pending,approved,rejected',
            'return_date' => 'nullable|date',
        ]);

        // ✅ SOLUTION 1: Get user_id from the selected order
        $order = Order::findOrFail($request->order_id);

        ReturnRequest::create([
            'order_id'    => $order->id,
            'user_id'     => $order->user_id, // Automatically get user_id
            'reason'      => $request->reason,
            'status'      => $request->status,
            'return_date' => $request->return_date,
        ]);

        return redirect()
            ->route('returns.index')
            ->with('success', '✅ Return request created successfully.');
    }

    public function update(Request $request, $id)
    {
        $return = ReturnRequest::findOrFail($id);

        $request->validate([
            'reason'      => 'nullable|string|max:1000',
            'status'      => 'required|in:pending,approved,rejected',
            'return_date' => 'nullable|date',
        ]);

        $return->update($request->all());

        return redirect()
            ->route('returns.index')
            ->with('success', '✅ Return request updated successfully.');
    }

    // ✅ SOLUTION 2: The updateStatus() method has been removed as it was redundant.

    public function destroy($id)
    {
        $return = ReturnRequest::findOrFail($id);
        $return->delete();

        return redirect()
            ->route('returns.index')
            ->with('success', '🗑️ Return request deleted successfully.');
    }
}
