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
Route::post('/transactions', [TransactionController::class, 'store'])
    ->name('transactions.store');
Route::get('/transactions/create', [TransactionController::class, 'create'])
    ->name('transactions.create');

Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
    ->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])
    ->name('transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
    ->name('transactions.destroy');
