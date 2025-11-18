<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomeUser');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Testing Routes - Remove after development phase

// Products Resource Routes
Route::resource('products', ProductController::class);

// Users Resource Routes
Route::resource('users', UserController::class);

// Orders Custom Routes
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');
    Route::get('/orders/create', 'create')->name('orders.create');
    Route::post('/orders', 'store')->name('orders.store');
    Route::get('/orders/{order}', 'show')->name('orders.show');
});

// Payments Custom Routes
Route::controller(PaymentController::class)->group(function () {
    Route::post('/payments', 'store')->name('payments.store');
    Route::get('/payments/{payment}', 'show')->name('payments.show');
    Route::post('/payments/callback', 'callback')->name('payments.callback');
});