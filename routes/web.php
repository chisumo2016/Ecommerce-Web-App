<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StripePaymentController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/dashboard',   [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/view-product/{product}', [HomeController::class, 'show'])->name('product.details');
Route::get('shop', [HomeController::class, 'shop'])->name('shop');



//Route::get('/dashboard', function () {
//    return view('front-end.index');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth','admin'])->name('admin.dashboard');
Route::resource('admin/categories', CategoryController::class)->middleware(['auth','admin']);
Route::resource('admin/products', ProductController::class) ->parameters(['products' => 'product:slug'])->middleware(['auth','admin']);

Route::get('search' , [ProductController::class, 'search'])->name('search');

Route::get('add_cart/{product}', [CartController::class,'cart'])->middleware(['auth','verified'])->name('add.cart');
Route::get('mycart', [CartController::class,'myCart'])->middleware(['auth','verified'])->name('mycart');
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->middleware(['auth','verified'])->name('cart.destroy');

Route::post('confirm_order', [OrderController::class,'confirm_order'])->middleware(['auth','verified'])->name('confirm.order');
Route::get('view_order', [\App\Http\Controllers\Admin\OrderController::class,'index'])->middleware(['auth','admin'])->name('orders.index');
Route::get('on_the_way/{id}', [\App\Http\Controllers\Admin\OrderController::class,'OnTheWay'])->middleware(['auth','admin'])->name('on.the.way');
Route::get('delivered/{id}', [\App\Http\Controllers\Admin\OrderController::class,'delivered'])->middleware(['auth','admin'])->name('delivered');

Route::get('pdf/{id}', [\App\Http\Controllers\Admin\OrderController::class,'pdf'])->middleware(['auth','admin'])->name('pdf');

Route::get('/my-order',   [OrderController::class, 'myOrders'])->middleware(['auth', 'verified'])->name('my.orders');


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe')->name('home.stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

//Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


require __DIR__.'/auth.php';
