<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB; // DB Facade ko import karein

class DashboardController extends Controller
{
    public function index()
    {
        // Metric 1: Total Revenue from completed orders (using 'total' column from your 'orders' table)
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // Metric 2: Pending Orders
        $pendingOrders = Order::where('status', 'pending')->count();

        // Metric 3: Total Customers (using 'role' column from your 'users' table)
        $totalCustomers = User::where('role', 'customer')->count();

        // Metric 4: Total Products
        $totalProducts = Product::count();

        // Metric 5: Custom Orders Count (Unique to your project!)
        // Yeh un orders ko count karega jin ke kisi bhi item ke sath customization record जुड़ा hua hai
        $customOrdersCount = Order::whereHas('orderItems.customization')->count();

        // Metric 6: Pending Return Requests
        // Hum DB Facade use kar rahe hain, in case 'Return' model na bana ho
        $pendingReturns = DB::table('returns')->where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'pendingOrders',
            'totalCustomers',
            'totalProducts',
            'customOrdersCount',
            'pendingReturns'
        ));
    }
}
