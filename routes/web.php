<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/about', function () {
    return view('site.about');
})->name('about');
Route::get('/contact', function () {
    return view('site.contact');
})->name('contact');
