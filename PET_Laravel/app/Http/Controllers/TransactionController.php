<?php

namespace App\Http\Controllers;

#use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category')->latest('transaction_date')
        ->paginate(10)->withQueryString();

        return view('transactions.index', compact('transactions'));
    }
}
