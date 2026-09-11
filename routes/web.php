<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

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
