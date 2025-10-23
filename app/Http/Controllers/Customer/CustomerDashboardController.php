<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Metric 1: Total Orders
        $totalOrders = Order::where('user_id', $userId)->count();

        // Metric 2: Pending Orders
        $pendingOrders = Order::where('user_id', $userId)
            ->whereIn('status', ['pending', 'confirmed', 'in_progress', 'shipped'])
            ->count();

        // Metric 3: Completed Orders
        $completedOrders = Order::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        // ✅ Metric 4: My Custom Orders (NEW)
        // Yeh sirf un orders ko count karega jinme customization request thi
        $customOrders = Order::where('user_id', $userId)
            ->whereHas('orderItems.customization') // Eloquent relationship ka istemal
            ->count();

        // Metric 5: Total Spent
        $totalSpent = Order::where('user_id', $userId)
            ->whereIn('status', ['confirmed', 'shipped', 'delivered', 'completed'])
            ->sum('total');

        return view('customer.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'customOrders', // Naya variable view ko pass karein
            'totalSpent'
        ));
    }
}
