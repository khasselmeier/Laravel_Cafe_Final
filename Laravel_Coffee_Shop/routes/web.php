<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

//Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

//Contact page
Route::view('/contact', 'contact')->name('contact');

//Menu page
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

//Product pages
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

//Cart routes (requires login)
Route::middleware('auth')->group(function() {
    //Add item to cart
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

    //Remove single item
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

    //Remove all items
    Route::delete('/cart/remove-all', [CartController::class, 'removeAll'])->name('cart.removeAll');

    //Checkout page
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::get('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
});

//Authentication
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
