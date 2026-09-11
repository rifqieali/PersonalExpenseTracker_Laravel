<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category_id = $request->query('category_id');
        $type = $request->query('type');
        $date_from = $request->query('date_from');
        $date_to = $request->query('date_to');

        $transactions = Transaction::with('category')
        ->when($search, function ($query, $search) {
            $query->where('description', 'like', "%{$search}%");
        })
        ->when($category_id, function ($query, $category_id) {
                $query->forCategory($category_id);
            })
        ->when($type, function ($query, $type) {
            $query->where('type', $type);
        })
        ->when($date_from, function ($query, $date_from) {
            $query->where('transaction_date', '>=', $date_from );
            })
        ->when($date_to, function ($query, $date_to) {
            $query->where('transaction_date', '<=', $date_to);
        })
        ->latest('transaction_date')
        ->paginate(10)
        ->withQueryString();

        $categories = Category::orderBy('name')->get();
        return view('transactions.index', compact('transactions', 'search', 'categories'));
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
