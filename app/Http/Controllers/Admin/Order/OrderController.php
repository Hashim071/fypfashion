<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'review', 'returnRequest'])
            ->latest()
            ->paginate(10);

        return view('admin.order.all_order', compact('orders'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'total'            => 'required|numeric|min:0',
            'delivery_address' => 'required|string|max:500',
            'payment_method'   => 'required|in:cod,payfast',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'total'            => $request->total,
            'delivery_address' => $request->delivery_address,
            'payment_method'   => $request->payment_method,
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order details updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,shipped,delivered,completed,returned',
        ]);

        $order = Order::with('items.product')->findOrFail($id);

        if ($request->status === 'confirmed' && $order->status !== 'confirmed') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $newQuantity = $item->product->quantity - $item->quantity;

                    $item->product->quantity = max(0, $newQuantity);
                    $item->product->save();
                }
            }
        }

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully and product quantities adjusted.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:cod,payfast',
            'payment_status' => 'required|in:unpaid,paid,partial,failed',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->back()->with('success', 'Payment details updated successfully.');
    }
    public function generateInvoice($id)
    {
        $order = Order::with(['user', 'items.product', 'items.customization'])->findOrFail($id);

        $pdf = PDF::loadView('admin.order.invoice', compact('order'));

        return $pdf->download('invoice-order-' . $order->id . '.pdf');
    }
    public function show($id)
    {
        $order = Order::with([
            'items.product',
            'items.customization',
            'user',
            'review',
            'returnRequest',
        ])->findOrFail($id);

        return view('admin.order.order_details', compact('order'));
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
