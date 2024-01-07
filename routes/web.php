<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/shop', [ProductController::class, 'index'])->name('shop');
    Route::get('/', [ProductController::class, 'index'])->name('shop');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/{product:id}', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/{product:id}/increase', [CartController::class, 'increase'])->name('cart.increase');
        Route::patch('/{product:id}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
        Route::delete('/empty', [CartController::class, 'empty'])->name('cart.empty');
        Route::delete('/{product:id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });
});

require __DIR__ . '/auth.php';
