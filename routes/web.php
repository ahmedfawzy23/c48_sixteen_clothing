<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');

    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::patch('/{product}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{product}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth')->name('checkout.store');



Route::middleware('auth')->group(function () {

    Route::get('/about', function () {
        return view('site.about');
    })->name('about');


    Route::get('/contact', function () {
        return view('site.contact');
    })->name('contact');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::view('/', 'admin.layouts.app');

    Route::resource('products', AdminProductController::class)->names('admin.products');
    Route::patch('products/{product}/toggle', [AdminProductController::class, 'toggle'])->name('admin.products.toggle');
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::post('orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});
