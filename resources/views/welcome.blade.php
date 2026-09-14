@extends('layouts.app')
@section('title','Welcome')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
    <h1 class="max-w-xl text-4xl font-bold tracking-tight text-stone-900 sm:text-5xl">Personal Expense Tracker</h1>
    <p class="mt-4 max-w-xl text-base leading-relaxed text-stone-600">Catat pemasukan dan pengeluaran harian, pantau saldo, dan rangkum belanja per kategori.</p>
    <div class="mt-8">
        <a href="{{ route('dashboard.index') }}" class="btn-primary">Ke Dashboard</a>
    </div>
</div>
@endsection
