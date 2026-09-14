@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-stone-900">Dashboard</h1>
                <p class="mt-1 text-sm text-stone-600">Ringkasan keuangan kamu.</p>
            </div>
            <form action="{{ route('dashboard.index') }}" method="GET" class="flex flex-col gap-2 sm:flex-row sm:items-end">
                <div>
                    <label for="date_from" class="fld-label">Dari tanggal</label>
                    <input id="date_from" type="date" name="date_from" value="{{ request('date_from') }}" class="fld-input">
                </div>
                <div>
                    <label for="date_to" class="fld-label">Sampai tanggal</label>
                    <input id="date_to" type="date" name="date_to" value="{{ request('date_to') }}" class="fld-input">
                </div>
                <button type="submit" class="btn-primary">Filter</button>
            </form>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="card p-6 md:col-span-2">
                <h2 class="text-sm font-medium text-stone-600">Saldo</h2>
                <p class="mt-1 font-mono text-4xl font-bold tracking-tight {{ $balance >= 0 ? 'text-emerald-700' : 'text-rose-600' }}">Rp{{ number_format($balance, 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-stone-500">Total pemasukan dikurangi total pengeluaran.</p>
            </div>
            <div class="flex flex-col gap-4">
                <div class="card flex-1 p-5">
                    <h2 class="text-sm font-medium text-stone-600">Pemasukan</h2>
                    <p class="mt-1 font-mono text-2xl font-bold text-stone-900">Rp{{ number_format($total_income, 0, ',', '.') }}</p>
                </div>
                <div class="card flex-1 p-5">
                    <h2 class="text-sm font-medium text-stone-600">Pengeluaran</h2>
                    <p class="mt-1 font-mono text-2xl font-bold text-stone-900">Rp{{ number_format($total_expense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-lg font-bold tracking-tight text-stone-900">Pengeluaran per kategori</h2>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                @forelse ($grouped_summary as $item)
                    <div class="card p-5">
                        <p class="text-sm font-medium text-stone-600">{{ $item->category->name ?? 'Tanpa kategori' }}</p>
                        <p class="mt-1 font-mono text-2xl font-bold text-stone-900">Rp{{ number_format($item->total, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <div class="card p-5 sm:col-span-2">
                        <p class="text-sm text-stone-600">Belum ada pengeluaran pada periode ini. Tambahkan transaksi pertamamu dari halaman Transaksi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
