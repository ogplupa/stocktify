<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function tampil()
    {
        $categories = Category::all();
        return view('product.category.tampil', compact('categories'));
    }

    public function tambah()
    {
        return view('product.category.tambah');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
        ]);

        Category::create($request->all());
        return redirect()->route('category.tampil')->with('success', 'Category berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('product.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('category.tampil')->with('success', 'Category berhasil diperbarui');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.tampil')->with('success', 'Category berhasil dihapus');
    }
}
