<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [HomeController::class, 'index'])->name('home');
//
//Route::prefix('/catalog')->group(function () {
//    Route::get('/', function () {
//        return redirect()->route('home');
//    });
//    Route::get('/{category:slug?}', [CatalogController::class, 'index'])->name('category');
//});
//
//Route::get('/cart', fn() => view('cart.index'))->name('cart');
//Route::get('/products/{slug}', fn() => view('products.show'))->name('product.show');
//Route::get('/admin', fn() => view('admin.index'))->name('admin');
Route::view('/tpl/home', 'home');
Route::view('/tpl/product', 'product');
