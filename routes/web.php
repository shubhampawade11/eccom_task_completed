<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
})->name('main-page');


// User routes
Route::get('login', [App\Http\Controllers\Auth\UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('login', [App\Http\Controllers\Auth\UserAuthController::class, 'login']);


// Admin routes
Route::get('admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'login']);



Route::middleware(['user.auth'])->group(function () {
    Route::get('user/home', [App\Http\Controllers\HomeController::class, 'HomePageUser']);
    Route::post('logout', [App\Http\Controllers\Auth\UserAuthController::class, 'logout'])->name('user.logout');
});

Route::middleware(['admin.auth'])->group(function () {
    Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'HomePageAdmin'])->name('home');
    Route::get('admin/add-product', [App\Http\Controllers\ProductController::class, 'create'])->name('product.add');
    Route::post('admin/product-store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');
    
});