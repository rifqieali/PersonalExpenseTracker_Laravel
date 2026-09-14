@extends('layouts.app')
@section('title','Transaksi')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-stone-900">Transaksi</h1>
            <p class="mt-1 text-sm text-stone-600">Semua pemasukan dan pengeluaran kamu.</p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn-primary">Tambah Transaksi</a>
    </div>

    <div class="card mt-6 p-4 sm:p-5">
        <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-6">
            <div class="lg:col-span-2">
                <label for="search" class="fld-label">Cari deskripsi</label>
                <input id="search" type="text" name="search" value="{{ $search ?? request('search') }}" placeholder="cth. makan siang" class="fld-input">
            </div>
            <div>
                <label for="category_id" class="fld-label">Kategori</label>
                <select id="category_id" name="category_id" class="fld-input">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="type" class="fld-label">Tipe</label>
                <select name="type" id="type" class="fld-input">
                    <option value="">Semua Tipe</option>
                    <option value="income" @selected(request('type') === 'income')>Pemasukan</option>
                    <option value="expense" @selected(request('type') === 'expense')>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label for="date_from" class="fld-label">Dari tanggal</label>
                <input id="date_from" type="date" name="date_from" value="{{ request('date_from') }}" class="fld-input">
            </div>
            <div>
                <label for="date_to" class="fld-label">Sampai tanggal</label>
                <input id="date_to" type="date" name="date_to" value="{{ request('date_to') }}" class="fld-input">
            </div>
            <div class="flex items-end gap-2 sm:col-span-2 lg:col-span-6">
                <button type="submit" class="btn-primary">Cari</button>
                @if (request()->hasAny(['search','category_id','type','date_from','date_to']))
                    <a href="{{ route('transactions.index') }}" class="btn-secondary">Reset</a>
                @endif
            </div>
        </form>
        @if ($search ?? request('search'))
            <p class="mt-3 text-sm text-stone-500">Hasil untuk "{{ $search ?? request('search') }}": {{ $transactions->total() }} data</p>
        @endif
    </div>

    <div x-data="{ open: false, selected: null, confirmOpen: false, deleteUrl: '', deleteLabel: '' }" @keydown.escape.window="open = false; confirmOpen = false">
        <div class="card mt-6 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-stone-200 bg-stone-50 text-left text-xs font-semibold uppercase tracking-wide text-stone-500">
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3 text-right">Nominal</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    @forelse($transactions as $t)
                        <tr class="transition hover:bg-stone-50">
                            <td class="whitespace-nowrap px-4 py-3 text-stone-600">{{ $t->transaction_date->format('d M Y') }}</td>
                            <td class="px-4 py-3 font-medium text-stone-900">{{ $t->description ?? '-' }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $t->category->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="{{ $t->type === 'income' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-600' }} inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold">{{ $t->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right font-mono font-semibold text-stone-900">Rp{{ number_format($t->amount, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                @php
                                    $row = ['description' => $t->description, 'category_name' => $t->category->name ?? '-', 'type' => $t->type, 'amount' => $t->amount, 'date' => $t->transaction_date->format('d M Y')];
                                @endphp
                                <button type="button" @click="selected = JSON.parse($event.currentTarget.dataset.row); open = true" data-row='@json($row)' class="font-medium text-stone-500 transition hover:text-stone-900">Detail</button>
                                <span class="mx-1 text-stone-300">|</span>
                                <a href="{{ route('transactions.edit', $t->id) }}" class="font-medium text-emerald-700 transition hover:text-emerald-800">Edit</a>
                                <span class="mx-1 text-stone-300">|</span>
                                <button type="button" @click="deleteUrl = $event.currentTarget.dataset.url; deleteLabel = $event.currentTarget.dataset.label; confirmOpen = true" data-url="{{ route('transactions.destroy', $t->id) }}" data-label="{{ $t->description ?? '-' }}" class="font-medium text-rose-600 transition hover:text-rose-700">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center">
                                <p class="font-medium text-stone-900">Belum ada transaksi</p>
                                <p class="mt-1 text-sm text-stone-500">Tambahkan transaksi pertamamu untuk mulai mencatat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="open" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="open = false" class="absolute inset-0 bg-stone-950/50"></div>
            <div @click.stop class="card relative w-full max-w-md p-6 shadow-xl">
                <h2 class="text-lg font-bold tracking-tight text-stone-900">Detail Transaksi</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between gap-4"><dt class="text-stone-500">Deskripsi</dt><dd class="font-medium text-stone-900" x-text="selected?.description ?? '-'"></dd></div>
                    <div class="flex justify-between gap-4"><dt class="text-stone-500">Kategori</dt><dd class="font-medium text-stone-900" x-text="selected?.category_name ?? '-'"></dd></div>
                    <div class="flex justify-between gap-4"><dt class="text-stone-500">Tipe</dt><dd class="font-medium text-stone-900" x-text="selected?.type ?? '-'"></dd></div>
                    <div class="flex justify-between gap-4"><dt class="text-stone-500">Nominal</dt><dd class="font-mono font-medium text-stone-900" x-text="selected?.amount ?? '-'"></dd></div>
                    <div class="flex justify-between gap-4"><dt class="text-stone-500">Tanggal</dt><dd class="font-medium text-stone-900" x-text="selected?.date ?? '-'"></dd></div>
                </dl>
                <div class="mt-6 flex justify-end">
                    <button type="button" @click="open = false" class="btn-secondary">Tutup</button>
                </div>
            </div>
        </div>

        <div x-show="confirmOpen" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div @click="confirmOpen = false" class="absolute inset-0 bg-stone-950/50"></div>
            <div @click.stop class="card relative w-full max-w-md p-6 shadow-xl">
                <h2 class="text-lg font-bold tracking-tight text-stone-900">Hapus transaksi?</h2>
                <p class="mt-2 text-sm text-stone-600">Transaksi <span class="font-semibold text-stone-900" x-text="deleteLabel"></span> akan dihapus permanen dan tidak bisa dikembalikan.</p>
                <form method="POST" :action="deleteUrl" class="mt-6 flex justify-end gap-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="confirmOpen = false" class="btn-secondary">Batal</button>
                    <button type="submit" class="btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
