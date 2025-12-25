<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Welcome Page
Route::get('/', function () {
    return view('welcomeUser');
});

// Dashboard (Authenticated Users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

// ═══════════════════════════════════════════════════════════
//                    APPLICATION ROUTES
// ═══════════════════════════════════════════════════════════

// Products Routes
Route::middleware('auth')->group(function () {
    // Public product browsing (all authenticated users)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    // Admin-only product management
    Route::middleware('Admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

// Orders Routes (Authenticated Users)
Route::middleware('auth')->controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');
    Route::get('/orders/create', 'create')->name('orders.create');
    Route::post('/orders', 'store')->name('orders.store');
    Route::get('/orders/{order}', 'show')->name('orders.show');
    Route::post('/orders/{order}/cancel', 'cancel')->name('orders.cancel');
});

// Payments Routes (Authenticated Users)
Route::middleware('auth')->controller(PaymentController::class)->group(function () {
    Route::post('/payments', 'store')->name('payments.store');
    Route::get('/payments/{payment}', 'show')->name('payments.show');
    Route::post('/payments/callback', 'callback')->name('payments.callback');
    Route::post('/payments/{payment}/refund', 'refund')->name('payments.refund');
});