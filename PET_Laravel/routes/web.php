<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transaksi', function () {
    return view('transaksi');
})->name('transaksi');

Route::get('/test-flash', function(){
    return redirect()->route('dashboard')
    ->with('success', 'Flash message successfully set!');
});
