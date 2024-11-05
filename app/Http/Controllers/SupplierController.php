<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function tampil()
    {
        $suppliers = Supplier::all();
        return view('product.supplier.tampil', compact('suppliers'));
    }

    public function tambah()
    {
        return view('product.supplier.tampil');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable|unique:suppliers,phone,required',
            'email' => 'nullable|email|unique:suppliers,email,required'
        ]);

        Supplier::create($request->all());
        return redirect()->route('product.supplier.tampil')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('product.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable|unique:suppliers,phone,' . $id,
            'email' => 'nullable|email|unique:suppliers,email,' . $id
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->route('product.supplier.tampil')->with('success', 'Supplier berhasil diperbarui');
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('product.supplier.tampil')->with('success', 'Supplier berhasil dihapus');
    }
}
