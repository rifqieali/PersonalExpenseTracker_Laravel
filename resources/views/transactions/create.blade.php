@extends('layouts.app')
@section('title','Tambah Transaksi')
@section('content')

<div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold tracking-tight text-stone-900">Tambah Transaksi</h1>
    <p class="mt-1 text-sm text-stone-600">Catat pemasukan atau pengeluaran baru.</p>
    <form action="{{ route('transactions.store') }}" method="POST" class="card mt-6 space-y-4 p-6">
        @csrf
        <div>
            <label for="transaction_date" class="fld-label">Tanggal</label>
            <input id="transaction_date" type="date" name="transaction_date" value="{{ old('transaction_date') }}" required class="fld-input">
            @error('transaction_date') <p class="fld-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="description" class="fld-label">Deskripsi</label>
            <input id="description" type="text" name="description" value="{{ old('description') }}" placeholder="cth. makan siang" class="fld-input">
            @error('description') <p class="fld-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="category_id" class="fld-label">Kategori</label>
            <select id="category_id" name="category_id" class="fld-input">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="fld-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="type" class="fld-label">Tipe</label>
            <select id="type" name="type" class="fld-input">
                <option value="income" @selected(old('type') == 'income')>Pemasukan</option>
                <option value="expense" @selected(old('type') == 'expense')>Pengeluaran</option>
            </select>
        </div>
        <div>
            <label for="amount" class="fld-label">Nominal (Rp)</label>
            <input id="amount" type="number" name="amount" value="{{ old('amount') }}" min="1" step="0.01" required class="fld-input">
            @error('amount') <p class="fld-error">{{ $message }}</p> @enderror
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="btn-primary">Simpan Transaksi</button>
            <a href="{{ route('transactions.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
