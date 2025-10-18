<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BarangMasuk;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // ✅ kirim data kategori ke form
        return view('pages.barang-masuk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pemasukan' => 'required|string',
            'nama_barang' => 'required|string',
            'category_id' => 'required|integer',
            'stock' => 'required|integer|min:1',
            'satuan' => 'required|string',
            'harga_total' => 'required|numeric',
        ]);

        // Simpan ke tabel barang-masuk
        BarangMasuk::create([
            'no_pemasukan' => $request->no_pemasukan,
            'nama_barang' => $request->nama_barang,
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'satuan' => $request->satuan,
            'harga_total' => $request->harga_total,
            'created_by' => Auth::user()->name ?? 'Unknown',
        ]);

        // Update ke tabel products
        $product = Product::firstOrNew([
            'nama_barang' => $request->nama_barang,
            'category_id' => $request->category_id,
        ]);

        $product->stock += $request->stock;
        $product->satuan = $request->satuan;
        $product->harga_total += $request->harga_total;
        $product->save();

        return redirect()->route('barangmasuk.create')->with('success', 'Barang berhasil ditambahkan');
    }
}
