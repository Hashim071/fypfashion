<?php

namespace App\Http\Controllers\Customer;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        // Check if the order belongs to the authenticated user
        $order = Auth::user()->orders()->find($request->order_id);
        if (!$order) {
            return redirect()->back()->with('error', 'This order does not belong to you.');
        }

        Review::updateOrCreate(
            [
                'order_id'   => $request->order_id,
                'product_id' => $request->product_id,
                'user_id'    => Auth::id(),
            ],
            [
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return redirect()->route('customer.orders.index')->with('success', 'Thank you for your review!');
    }
}
