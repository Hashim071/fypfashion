<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Transaction;

class PayfastController extends Controller
{
    public function initiatePayment($orderId)
    {
        // dd('TEST: Main Payfast Controller tak pohnch gaya hoon!');

        $merchantId = config('services.payfast.merchant_id');
        $secureKey  = config('services.payfast.secured_key');
        $currency   = 'PKR';

        // 🟢 Order fetch karo
        $order = Order::findOrFail($orderId);
        $basketId = 'ORDER-' . $order->id . '-' . now()->format('YmdHis');
        $amount   = $order->total;

        // Access Token fetch karo
        $response = Http::asForm()->post(config('services.payfast.base_url') . '/api/Transaction/GetAccessToken', [
            'MERCHANT_ID'   => $merchantId,
            'SECURED_KEY'   => $secureKey,
            'BASKET_ID'     => $basketId,
            'TXNAMT'        => $amount,
            'CURRENCY_CODE' => $currency,
        ]);

        $data = $response->json();

        Log::info('PayFast Access Token Response:', $data);

        if (!isset($data['ACCESS_TOKEN'])) {
            return back()->with('error', 'Error fetching PayFast token.');
        }

        $token = $data['ACCESS_TOKEN'];

        return view('payfast.form', compact('merchantId', 'basketId', 'amount', 'token', 'order'));
    }

    public function paymentSuccess(Request $request)
    {
        dd('TEST: Main Payfast Controller tak pohnch gaya hoon!');

        Log::info('🔹 Payment Success Callback', $request->all());

        $merchantId = config('services.payfast.merchant_id');
        $secureKey  = config('services.payfast.secured_key');
        $basketId   = $request->input('basket_id');
        $errCode    = $request->input('err_code');
        $hash       = $request->input('validation_hash');

        // ✅ Verify hash
        $string = $basketId . '|' . $secureKey . '|' . $merchantId . '|' . $errCode;
        $calculatedHash = hash('sha256', $string);

        if ($hash !== $calculatedHash) {
            Log::warning('❌ Hash mismatch!', ['received' => $hash, 'calculated' => $calculatedHash]);
            return redirect()->route('orders.index')->with('error', 'Hash verification failed.');
        }

        // ✅ Success case
        if ($errCode === "000") {
            $orderId = explode('-', $basketId)[1]; // ORDER-{id}-timestamp
            $order   = Order::findOrFail($orderId);

            // Update payment status
            $order->update(['payment_status' => 'paid']);

            // Save transaction
            Transaction::create([
                'order_id'       => $order->id,
                'transaction_id' => $request->input('transaction_id') ?? $request->input('TxnId'),
                'basket_id'      => $basketId,
                'issuer_name'    => $request->input('issuer_name'),
                'payment_name'   => $request->input('PaymentName'),
                'amount'         => $request->input('transaction_amount') ?? $order->total,
                'status'         => 'success',
            ]);
            return redirect()->route('orders.show', $order->id)->with('success', 'Payment successful!');
        }

        // ❌ Failure case
        return redirect()->route('orders.index')->with('error', 'Payment failed: ' . $request->input('err_msg'));
    }

    public function paymentFailure(Request $request)
    {
        Log::error('❌ Payment Failure:', $request->all());
        return redirect()->route('orders.index')->with('error', 'Payment was cancelled or failed.');
    }
}
