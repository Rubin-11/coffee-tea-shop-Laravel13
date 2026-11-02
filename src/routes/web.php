<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [CatalogController::class, 'search'])->name('search');

// Статичные страницы: шаблон уже лежит в resources/views/pages, отдельный контроллер не нужен
Route::view('/pages/about', 'pages.about')->name('pages.about');
Route::view('/pages/contacts', 'pages.contacts')->name('pages.contacts');
Route::view('/pages/delivery', 'pages.delivery')->name('pages.delivery');
Route::view('/pages/privacy', 'pages.privacy')->name('pages.privacy');
Route::view('/pages/returns', 'pages.returns')->name('pages.returns');
Route::view('/pages/terms', 'pages.terms')->name('pages.terms');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::prefix('catalog')->group(function () {
    Route::get('/{slug}', [CatalogController::class, 'index'])->name('catalog');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
