<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillController;

// Rute untuk menampilkan form order
Route::get('/order', [OrderController::class, 'showOrderForm'])->name('showOrderForm');

// Rute untuk mengirimkan order
Route::post('/submit-order', [OrderController::class, 'submitOrder'])->name('submitOrder');

// Rute untuk menampilkan detail order berdasarkan ID
Route::get('/order/{id}', [OrderController::class, 'showOrder'])->name('showOrder');

// Rute untuk menampilkan tagihan berdasarkan order ID
Route::get('/bill/{orderId}', [BillController::class, 'printBill'])->name('printBill');
