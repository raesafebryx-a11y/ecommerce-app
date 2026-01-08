<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        // Mengambil data kategori dengan pagination.
        // withCount('products'): Menghitung jumlah produk di setiap kategori.
        // Teknik ini jauh lebih efisien daripada memanggil $category->products->count() di view (N+1 Problem).
        $categories = Category::withCount('products')
            ->latest() // Urutkan dari yang terbaru (created_at desc)
            ->paginate(10); // Batasi 10 item per halaman

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
   public function store(Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'is_active' => 'required|boolean'
    ]);

    $data['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('categories', 'public');
    }

    Category::create($data);
    return back()->with('success', 'Kategori berhasil ditambahkan!');
}

    /**
     * Memperbarui data kategori.
     */
   public function update(Request $request, Category $category) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'is_active' => 'required|boolean'
    ]);

    $data['slug'] = Str::slug($request->name);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($category->image) Storage::disk('public')->delete($category->image);
        $data['image'] = $request->file('image')->store('categories', 'public');
    }

    $category->update($data);
    return back()->with('success', 'Kategori diperbarui!');
}

    /**
     * Menghapus kategori.
     */
    public function destroy(Category $category)
    {
        // 1. Safeguard (Pencegahan)
        // Jangan hapus kategori jika masih ada produk di dalamnya.
        // Ini mencegah produk menjadi "yatim piatu" (orphan data) yang tidak punya kategori.
        if ($category->products()->exists()) {
            return back()->with('error',
                'Kategori tidak dapat dihapus karena masih memiliki produk. Silahkan pindahkan atau hapus produk terlebih dahulu.');
        }

        // 2. Hapus file gambar fisik dari storage
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // 3. Hapus record dari database
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
