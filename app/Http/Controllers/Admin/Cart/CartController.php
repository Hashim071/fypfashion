<?php

namespace App\Http\Controllers\Admin\Cart;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show all cart items.
     */
    public function index()
    {
        $cartItems = CartItem::with(['user', 'product'])->get();
        return view('admin.cart.all_cart', compact('cartItems'));
    }

    /**
     * Remove a cart item.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Cart item removed successfully.');
    }
}
