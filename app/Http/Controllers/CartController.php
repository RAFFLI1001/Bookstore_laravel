<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function index() {
        $carts = Cart::with('book')->where('user_id', auth()->id())->get();
        $total = $carts->sum(fn($c) => $c->subtotal);
        return view('cart.index', compact('carts','total'));
    }

    public function add(Request $request) {
        $request->validate(['book_id' => 'required|exists:books,id']);

        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        $cart = Cart::where('user_id', auth()->id())
                    ->where('book_id', $request->book_id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'book_id' => $request->book_id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Buku ditambahkan ke keranjang!');
    }

    public function remove($id) {
        Cart::where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cart = Cart::findOrFail($id);

    // Cek stok
    if ($request->quantity > $cart->book->stock) {
        return back()->with('error', 'Stok tidak cukup!');
    }

    $cart->update([
        'quantity' => $request->quantity
    ]);

    return back()->with('success', 'Jumlah berhasil diupdate!');
}
}