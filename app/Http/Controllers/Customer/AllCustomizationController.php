<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllCustomizationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $customizations = Customization::whereHas('orderItem.order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with(['orderItem.product', 'orderItem.order'])
            ->latest()
            ->paginate(10);

        return view('customer.customization.all_customization', compact('customizations'));
    }
}
