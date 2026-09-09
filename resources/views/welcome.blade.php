@extends('layouts.app')
@section('title','Welcome')
@section('content')
<h1 class="text-2xl font-bold">Personal Expense Tracker</h1>
<a href="{{ route('dashboard') }}" class="underline">Ke Dashboard</a>
@endsection
