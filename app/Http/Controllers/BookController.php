<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function show($id) {
        $book = Book::with('category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function search(Request $request) {
        $query      = $request->get('q');
        $books      = Book::with('category')
                        ->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('author', 'LIKE', "%{$query}%")
                        ->get();
        $categories = Category::all();
        return view('books.search', compact('books','query','categories'));
    }
}