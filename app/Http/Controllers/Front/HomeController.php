<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('front-end.index',compact('products'));
    }

    public function show(Product $product)
    {

      return  view('front-end.show',compact('product'));
    }
}
