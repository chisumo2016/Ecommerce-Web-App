<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\order;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm_order(Request $request)
    {

        $userId = Auth::user()->id;
        $carts  = Cart::where('user_id', $userId)->get();

        foreach ($carts   as $cart){
            Order::create([
                'name' => $request->name,
                'shipping_address' => $request->address,
                'phone' => $request->phone,
                'user_id' => $userId,
                'product_id' => $cart->product_id,
            ]);
        }

        Cart::where('user_id', $userId)->delete();

        Flasher::addSuccess('Product Ordered  successfully.');
        return redirect()->back();
    }
}
