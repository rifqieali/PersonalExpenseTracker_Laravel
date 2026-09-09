<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category')->latest('transaction_date')
        ->paginate(10)->withQueryString();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('transactions.create', compact('categories'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        Transaction::create($validated);
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }
}
