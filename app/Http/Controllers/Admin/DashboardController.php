<?php

namespace App\Http\Controllers\Admin;
use App\Http\controllers\controller;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        $totalUsers = User::count();
        $totalAllUsers = User::where('role','user')->count();
        $totalAdmins = User::where('role','admin')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at',$todayDate)->count();
        $thisMonthOrders = Order::whereMonth('created_at',$thisMonth)->count();
        $thisYearOrders = Order::whereYear('created_at',$thisYear)->count();

        return view('admin.dashboard',compact('totalCategories','totalProducts','totalUsers','totalAllUsers','totalAdmins','totalOrders','todayOrders','thisMonthOrders','thisYearOrders'));
    }
}
