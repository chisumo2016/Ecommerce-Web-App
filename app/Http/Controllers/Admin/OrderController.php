<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\order;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::all();
        return  view('admin.orders.index',  compact('orders'));
    }

    public function OnTheWay($id)
    {
        $order = order::findOrFail($id);
        $order->status  = 'On the  way';
        $order->save();

        return redirect('view_order');
    }

    public function delivered($id)
    {
        $order = order::findOrFail($id);
        $order->status  = 'delivered';
        $order->save();

        return redirect('view_order');
    }
}
