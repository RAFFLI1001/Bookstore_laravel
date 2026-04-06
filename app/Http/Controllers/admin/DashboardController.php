<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, User, Order, Message, Category};

class DashboardController extends Controller {
    public function index() {
        return view('admin.dashboard', [
            'totalBooks'    => Book::count(),
            'totalUsers'    => User::where('role','user')->count(),
            'totalOrders'   => Order::count(),
            'totalMessages' => Message::where('is_read', false)->count(),
            'recentOrders'  => Order::with('user')->latest()->take(5)->get(),
        ]);
    }
}