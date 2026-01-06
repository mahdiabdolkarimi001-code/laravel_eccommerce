<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $orderCount = Order::count();
        $productCount = Product::count();

        $users = User::all(); // اضافه شده: گرفتن همه کاربران برای نمایش در ویو

        return view('admin.dashboard', compact('userCount', 'orderCount', 'productCount', 'users'));
    }
}
