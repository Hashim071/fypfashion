<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Show all transactions
     */
    public function index()
    {
        $transactions = Transaction::with('order.user')
            ->latest()
            ->paginate(10);

        return view('admin.transaction.all_transactions', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with('order.user')->findOrFail($id);

        return view('admin.transaction.show_transaction', compact('transaction'));
    }
}
