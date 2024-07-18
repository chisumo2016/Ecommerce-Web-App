<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\order;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($value)
    {
        return view('front-end.stripe', compact('value'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $value): \Illuminate\Http\RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Stripe\Charge::create([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment complete"
            ]);

            // Retrieve authenticated user details
            $user = Auth::user();
            $userId = $user->id;

            // Fetch user cart items
            $carts = Cart::where('user_id', $userId)->get();

            // Create orders for each cart item
            foreach ($carts as $cart) {
                Order::create([
                    'name' => $user->name,
                    'shipping_address' => $user->shipping_address,
                    'phone' => $user->phone,
                    'user_id' => $userId,
                    //'status' => $user->status,
                    'product_id' => $cart->product_id,
                    'payment_status' => "paid"
                ]);
            }

            // Clear the user's cart
            Cart::where('user_id', $userId)->delete();

            // Flash success message
            Session::flash('success', 'Payment successful!');

        } catch (\Exception $e) {
            Session::flash('error', 'Payment failed: '.$e->getMessage());
        }

        return back();
    }

}
