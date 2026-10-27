<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{id}', [HomeController::class, 'productDetail'])->name('products.detail');
Route::get('/articles', [HomeController::class, 'articles'])->name('articles');
Route::get('/articles/{id}', [HomeController::class, 'articleDetail'])->name('articles.detail');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/company', [HomeController::class, 'about'])->name('company');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/{slug}/{child?}', [HomeController::class, 'subpage'])
    ->where('slug', '^(?!admin$)[^/]+')
    ->name('subpage');
