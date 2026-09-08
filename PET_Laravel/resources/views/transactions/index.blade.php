@extends('layouts.app')
@section('title','Transaksi')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-8">
<h1 class="text-2xl font-bold mb-4">Transaksi</h1>
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
<td><a href="#">Tambah</a> <a href="#">Edit</a></td>
</tr>
@empty
<tr><td colspan="6">Belum ada transaksi</td></tr>
@endforelse
</tbody>
</table>
{{ $transactions->links() }}
</div>
@endsection
