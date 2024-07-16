<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/dashboard',   [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/view-product/{product}', [HomeController::class, 'show'])->name('product.details');

//Route::get('/dashboard', function () {
//    return view('front-end.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth','admin']);
Route::resource('admin/categories', CategoryController::class)->middleware(['auth','admin']);
Route::resource('admin/products', ProductController::class)->middleware(['auth','admin']);

Route::get('search' , [ProductController::class, 'search'])->name('search');

Route::get('add_cart/{product}', [CartController::class,'cart'])->middleware(['auth','verified'])->name('add.cart');
Route::get('mycart', [CartController::class,'myCart'])->middleware(['auth','verified'])->name('mycart');
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->middleware(['auth','verified'])->name('cart.destroy');

Route::post('confirm_order', [OrderController::class,'confirm_order'])->middleware(['auth','verified'])->name('confirm.order');
Route::get('view_order', [\App\Http\Controllers\Admin\OrderController::class,'index'])->middleware(['auth','admin'])->name('orders.index');



require __DIR__.'/auth.php';
