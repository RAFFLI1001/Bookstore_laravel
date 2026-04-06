<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, Category};
use Illuminate\Http\Request;

class BookController extends Controller {
    public function index() {
        return view('admin.books.index', ['books' => Book::with('category')->latest()->get()]);
    }

    public function create() {
        return view('admin.books.create', ['categories' => Category::all()]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:200',
            'author'      => 'required|string|max:100',
            'publisher'   => 'nullable|string|max:100',
            'year'        => 'nullable|integer',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'isbn'        => 'nullable|string|max:20',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);
        return redirect('/admin/books')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book) {
        return view('admin.books.edit', ['book' => $book, 'categories' => Category::all()]);
    }

    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:200',
            'author'      => 'required|string|max:100',
            'publisher'   => 'nullable|string|max:100',
            'year'        => 'nullable|integer',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'isbn'        => 'nullable|string|max:20',
            'cover'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);
        return redirect('/admin/books')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect('/admin/books')->with('success', 'Buku dihapus.');
    }
}