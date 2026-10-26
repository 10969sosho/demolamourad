<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/company', [HomeController::class, 'about'])->name('company');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/{slug}/{child?}', [HomeController::class, 'subpage'])
    ->where('slug', '^(?!admin$)[^/]+')
    ->name('subpage');
