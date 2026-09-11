<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date_from = $request->query('date_from');
        $date_to = $request->query('date_to');
        $total_income = Transaction::where('type', 'income')
        ->when($date_from, function ($query, $date_from) {
            $query->where('transaction_date', '>=', $date_from);
        })
        ->when($date_to, function ($query, $date_to) {
            $query->where('transaction_date', '<=', $date_to);
        })
        ->sum('amount');
        $total_expense = Transaction::where('type', 'expense')
        ->when($date_from, function ($query, $date_from) {
            $query->where('transaction_date', '>=', $date_from);
        })
        ->when($date_to, function ($query, $date_to) {
            $query->where('transaction_date', '<=', $date_to);
        })
        ->sum('amount');
        $balance = $total_income - $total_expense;
        $grouped_summary = Transaction::select('category_id', \DB::raw('SUM(amount) as total'))
            ->where('type', 'expense')
        ->when($date_from, function ($query, $date_from) {
            $query->where('transaction_date', '>=', $date_from);
        })
        ->when($date_to, function ($query, $date_to) {
            $query->where('transaction_date', '<=', $date_to);
        })
            ->groupBy('category_id')
            ->get();


        return view('dashboard.index', compact('total_income', 'total_expense', 'balance', 'grouped_summary'));
    }
}
