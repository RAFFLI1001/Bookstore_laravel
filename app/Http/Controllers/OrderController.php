<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function checkout(Request $request) {
        $request->validate([
            'shipping_address' => 'required|string',
        ]);

        $carts = Cart::with('book')->where('user_id', auth()->id())->get();
        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        DB::transaction(function () use ($carts, $request) {
            $total = $carts->sum(fn($c) => $c->subtotal);

            $order = Order::create([
                'user_id'          => auth()->id(),
                'total_price'      => $total,
                'shipping_address' => $request->shipping_address,
                'payment_method'   => 'payment_at_delivery',
                'note'             => $request->note,
                'status'           => 'pending',
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $cart->book_id,
                    'quantity' => $cart->quantity,
                    'price'    => $cart->book->price,
                ]);
                $cart->book->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', auth()->id())->delete();
        });

        return redirect('/orders')->with('success', 'Pesanan berhasil dibuat! Bayar saat buku tiba.');
    }

    public function myOrders() {
        $orders = Order::with('orderItems.book')
                    ->where('user_id', auth()->id())
                    ->latest()->get();
        return view('orders.index', compact('orders'));
    }
}