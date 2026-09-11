@extends('layouts.app')
@section('title','Transaksi')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-8">
<h1 class="text-2xl font-bold mb-4">Transaksi</h1>
<button><a href="{{ route('transactions.create') }}" class="text-blue-500 hover:text-blue-700">Tambah</a></button>

<div class="border-2 border-black p-3 mb-0 bg-white" style="border-color: var(--ink);">
    <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-col sm:flex-row gap-2">
        <label for="search" class="sr-only">Search Transaksi</label>
        <input id="search" type="text" name="search" value="{{ $search ?? request('search') }}"
               placeholder="search deskripsi"
               class="fld-input font-micro text-[12px] flex-1" style="text-transform: uppercase;" />
    <div class="mt-4">
        <label for="category_id" class="sr-only">Kategori</label>
        <select id="category_id" name="category_id" class="fld-input font-micro text-[12px]">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category -> id }}" @selected(request('category_id')== $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="type" id="type" class="fld-input font-micro text-[12px]">
            <option value="">Semua Tipe</option>
            <option value="income" @selected(request('type') === 'income')>Pendapatan</option>
            <option value="expense" @selected(request('type') === 'expense')>Pengeluaran</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}">
        <input type="date" name="date_to" value="{{ request('date_to') }}">
    <button type="submit" class="btn btn-primary">Search &gt;&gt;&gt;</button>
        @if (request()->hasAny(['search','category_id','type','date_from','date_to']))
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary text-center">Reset</a>
        @endif
    </div>
    </form>
    @if ($search ?? request('search'))
        <p class="font-micro text-[11px] mt-2">FILTER: "{{ $search ?? request('search') }}" /// {{ $transactions->total() }} RECORD(S)</p>
    @endif
</div>



<table class="w-full border">
<thead><tr><th>Tanggal</th><th>Deskripsi</th><th>Kategori</th><th>Tipe</th><th>Nominal</th><th>Aksi</th></tr></thead>
<tbody>
@forelse($transactions as $t)
<tr>
<td>{{ $t->transaction_date->format('d M Y') }}</td>
<td>{{ $t->description ?? '-' }}</td>
<td>{{ $t->category->name ?? '-' }}</td>
<td><span class="{{ $t->type==='income' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} px-2 rounded">{{ $t->type }}</span></td>
<td>Rp {{ number_format($t->amount,0,',','.') }}</td>
<td>
    <a href="{{ route('transactions.edit', $t->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
    <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Hapus</button>
    </form>
</td>
</tr>
@empty
<tr><td colspan="6">Belum ada transaksi</td></tr>
@endforelse
</tbody>
</table>
{{ $transactions->links() }}
</div>
@endsection
