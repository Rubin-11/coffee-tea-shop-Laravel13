<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('catalog')->group(function () {
    Route::get('/{slug}', [CatalogController::class, 'index'])->name('catalog');
});
