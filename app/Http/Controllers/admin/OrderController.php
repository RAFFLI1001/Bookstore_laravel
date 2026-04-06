<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index() {
        $orders = Order::with(['user','orderItems.book'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id) {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        Order::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui.');
    }
}