<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $count = 0;

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $count = Cart::where('user_id', $userId)->count();
        }

        return view('front-end.index',compact('products', 'count'));
    }

    public function show(Product $product)
    {
        $count = 0;
        /*check if there's logged id*/
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $count = Cart::where('user_id', $userId)->count();
        }

      return  view('front-end.show',compact('product','count'));
    }
}
