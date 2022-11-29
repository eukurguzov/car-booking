<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('orders', OrderController::class)->except(['show']);
Route::post('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
