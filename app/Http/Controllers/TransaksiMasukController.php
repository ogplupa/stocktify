<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMasuk;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function tampil()
    {
        $transaksi = TransaksiMasuk::with(['product', 'user'])->get();
        return view('transaksi.masuk.tampil', compact('transaksi'));
    }

    public function tambah()
    {
        $products = Product::all();
        return view('transaksi.masuk.tambah', compact('products'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'date' => 'required|date',
            'supplier' => 'required',
        ]);

        TransaksiMasuk::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => 'pending',
            'supplier' => $request->supplier,
            'notes' => $request->notes
        ]);

        return redirect()->route('transaksi.masuk.tampil')
            ->with('success', 'Transaksi masuk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = TransaksiMasuk::findOrFail($id);
        $products = Product::all();
        return view('transaksi.masuk.edit', compact('transaksi', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'date' => 'required|date',
            'supplier' => 'required',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $transaksi = TransaksiMasuk::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.masuk.tampil')
            ->with('success', 'Transaksi masuk berhasil diupdate');
    }

    public function delete($id)
    {
        $transaksi = TransaksiMasuk::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.masuk.tampil')
            ->with('success', 'Transaksi masuk berhasil dihapus');
    }
} 