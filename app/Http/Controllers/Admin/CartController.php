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
}
