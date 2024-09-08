<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

route::post('addproducts', function(){
    return view('addproducts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/addproducts', [ProductController::class, 'create'])->name('products.create');
Route::post('/addproducts', [ProductController::class, 'store'])->name('products.store');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');