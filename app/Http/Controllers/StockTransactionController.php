<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\Type;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user', 'type', 'status'])
            ->latest()
            ->paginate(10);

        return view('stock-transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        $types = Type::all();
        $statuses = Status::all();

        return view('stock-transactions.create', compact('products', 'types', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type_id' => 'required|exists:types,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Buat transaksi
            $transaction = StockTransaction::create([
                ...$validated,
                'user_id' => auth()->id(),
            ]);

            // Update stok produk berdasarkan tipe transaksi
            $product = Product::find($request->product_id);
            
            if ($request->type_id == 1) { // Masuk
                $product->increment('stock', $request->quantity);
            } else { // Keluar
                // Validasi stok cukup
                if ($product->stock < $request->quantity) {
                    throw new \Exception('Stok tidak mencukupi');
                }
                $product->decrement('stock', $request->quantity);
            }

            DB::commit();
            return redirect()
                ->route('stock-transactions.index')
                ->with('success', 'Transaksi berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(StockTransaction $stockTransaction)
    {
        $stockTransaction->load(['product', 'user', 'type', 'status']);
        return view('stock-transactions.show', compact('stockTransaction'));
    }

    public function edit(StockTransaction $stockTransaction)
    {
        $products = Product::all();
        $types = Type::all();
        $statuses = Status::all();

        return view('stock-transactions.edit', compact('stockTransaction', 'products', 'types', 'statuses'));
    }

    public function update(Request $request, StockTransaction $stockTransaction)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type_id' => 'required|exists:types,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Kembalikan stok ke kondisi sebelumnya
            $product = Product::find($stockTransaction->product_id);
            if ($stockTransaction->type_id == 1) { // Masuk
                $product->decrement('stock', $stockTransaction->quantity);
            } else { // Keluar
                $product->increment('stock', $stockTransaction->quantity);
            }

            // Update stok dengan nilai baru
            $newProduct = Product::find($request->product_id);
            if ($request->type_id == 1) { // Masuk
                $newProduct->increment('stock', $request->quantity);
            } else { // Keluar
                if ($newProduct->stock < $request->quantity) {
                    throw new \Exception('Stok tidak mencukupi');
                }
                $newProduct->decrement('stock', $request->quantity);
            }

            // Update transaksi
            $stockTransaction->update($validated);

            DB::commit();
            return redirect()
                ->route('stock-transactions.index')
                ->with('success', 'Transaksi berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(StockTransaction $stockTransaction)
    {
        DB::beginTransaction();
        try {
            // Kembalikan stok ke kondisi sebelumnya
            $product = Product::find($stockTransaction->product_id);
            if ($stockTransaction->type_id == 1) { // Masuk
                $product->decrement('stock', $stockTransaction->quantity);
            } else { // Keluar
                $product->increment('stock', $stockTransaction->quantity);
            }

            // Hapus transaksi
            $stockTransaction->delete();

            DB::commit();
            return redirect()
                ->route('stock-transactions.index')
                ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Method tambahan untuk mengubah status transaksi
    public function updateStatus(Request $request, StockTransaction $stockTransaction)
    {
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id'
        ]);

        $stockTransaction->update($validated);

        return redirect()
            ->route('stock-transactions.show', $stockTransaction)
            ->with('success', 'Status transaksi berhasil diperbarui');
    }
} 