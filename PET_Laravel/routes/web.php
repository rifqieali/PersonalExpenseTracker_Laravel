<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transactions', [TransactionController::class, 'index'])
    ->name('transactions.index');

Route::get('/test-flash', function(){
    return redirect()->route('dashboard')
    ->with('success', 'Flash message successfully set!');
});
