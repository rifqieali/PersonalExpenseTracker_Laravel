@extends('layouts.app')
@section('title','Tambah Transaksi')
@section('content')

<div class="mx-auto max-w-7xl px-4 py-8">
<h1 class="text-2xl font-bold mb-4">Edit Transaksi</h1>
<form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-4">
@csrf
@method('PUT')
<div>
<label for="transaction_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
<input type="date" name="transaction_date"
value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required>
@error('transaction_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

<input type="text" name="description" value="{{ old('description', $transaction->description) }}">
@error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

<select name="category_id">
<option value="">Pilih Kategori</option>
@foreach($categories as $category)
<option value="{{ $category->id }}" @selected(old('category_id', $transaction->category_id) == $category->id)>{{ $category->name }}</option>
@endforeach
</select>
@error('category_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

<select name="type"><option value="income" @selected(old('type', $transaction->type)=='income')>Pemasukan</option><option value="expense" @selected(old('type', $transaction->type)=='expense')>Pengeluaran</option></select>

<input type="number" name="amount" value="{{ old('amount', $transaction->amount) }}" min="1" step="0.01" required>
@error('amount') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
<div>
<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
    Simpan Transaksi
</button>
</div>
</form>
</div>
@endsection
