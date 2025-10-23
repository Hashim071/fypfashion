<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a paginated list of reviews
     */
    public function index()
    {
        $reviews = Review::with(['order', 'user', 'product'])
            ->latest()
            ->paginate(10);

        return view('admin.review.all_review', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'user_id'    => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        Review::create([
            'order_id'   => $request->order_id,
            'user_id'    => $request->user_id,
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review added successfully.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
