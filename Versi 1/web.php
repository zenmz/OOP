<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('order', [OrderController::class,'index'])->name('order');
Route::post('order', [OrderController::class,'order'])->name('order');

