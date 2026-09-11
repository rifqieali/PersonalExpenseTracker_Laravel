@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p>Welcome to your Personal Expense Tracker!</p>

        <div>
            <form action="{{ route('dashboard.index') }}" method="GET">
                <input type="date" name="date_from" value="{{ request('date_from') }}">
                <input type="date" name="date_to" value="{{ request('date_to') }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
            </form>
            </div>
        <div class="">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Total Income</h2>
                <p class="text-3xl font-bold text-green-500">Rp.{{ number_format($total_income, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Total Expense</h2>
                <p class="text-3xl font-bold text-red-500">Rp.{{ number_format($total_expense, 2) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Balance</h2>
                <p class="text-3xl font-bold {{ $balance >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    Rp.{{ number_format($balance, 2) }}
                </p>
            </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Expense by Category</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($grouped_summary as $item)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="font-medium">{{ $item->category->name ?? 'Unknown' }}</p>
                        <p class="text-lg font-bold text-red-500">Rp.{{ number_format($item->total, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
