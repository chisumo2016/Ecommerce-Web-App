<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(Product $product)
    {

        Auth::user()->carts()->create([
            'product_id' => $product->id,
        ]);

        Flasher::addSuccess('Product Added to the Cart Created Successfully!');
        return redirect()->back();
    }

    public function myCart()
    {
        $count = 0;
        /*check if there's logged id*/
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $count = Cart::where('user_id', $userId)->count();

            $carts = Cart::where('user_id', $userId)->get();
        }
        return  view('front-end.myCart', compact('count','carts'));
    }
}
