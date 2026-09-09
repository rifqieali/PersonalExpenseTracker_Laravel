<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

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

    public function edit(Transaction $transaction)
    {
        $categories = Category::orderBy('name')->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validated = $request->validated();
        $transaction->update($validated);
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
