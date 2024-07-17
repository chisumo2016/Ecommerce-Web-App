<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('userType', 'user')->get()->count();
        $products = Product::all()->count();
        $orders =   order::all()->count();
        $delivered = order::where('status', 'delivered')->get()->count();
        return view('admin.index', compact('users','products','orders', 'delivered'));
    }
}
