<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product', 'review', 'returnRequest'])
            ->latest()
            ->paginate(10);

        return view('customer.order.all_order', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with([
                'items.product',
                'items.customization',
                'user',
                'review',
                'returnRequest',
            ])->findOrFail($id);

        return view('customer.order.order_details', compact('order'));
    }
    public function generateInvoice($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['user', 'items.product', 'items.customization'])
            ->findOrFail($id);

        $pdf = PDF::loadView('customer.order.invoice', compact('order'));

        // Naming the invoice file
        return $pdf->download('invoice-customcouture-' . $order->id . '.pdf');
    }
}
