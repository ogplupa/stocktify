<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function tampil()
    {
        $products = Product::with(['supplier', 'category'])->get();
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('product.barang.tampil', compact('products', 'suppliers', 'categories'));
    }

    public function tambah()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('product.barang.tambah', compact('suppliers', 'categories'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'image' => $imagePath,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('product.tampil')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('product.barang.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'supplier_id' => 'required|exists:suppliers,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id
        ];

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('product.tampil')->with('success', 'Produk berhasil diperbarui!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.tampil')->with('success', 'Produk berhasil dihapus!');
    }
}
