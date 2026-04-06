<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    public function index() {
        return view('admin.categories.index', [
            'categories' => Category::withCount('books')->get()
        ]);
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:100|unique:categories']);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect('/admin/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name,'.$category->id]);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect('/admin/categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Kategori dihapus.');
    }
}