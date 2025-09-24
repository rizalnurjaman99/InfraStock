<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BarangMasuk;
use App\Product;
use App\Category;

class BarangMasukController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('pages.barang-masuk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pemasukan' => 'nullable|string|max:50',
            'nama_barang'  => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'stock'        => 'required|integer|min:1',
            'satuan'       => 'required|string|max:50',
            'harga_total'  => 'required|numeric|min:0',
        ]);

        $noPemasukan = $request->no_pemasukan;
        $namaBarang  = $request->nama_barang;
        $categoryId  = $request->category_id;
        $stockTambah = $request->stock;
        $satuan      = $request->satuan;
        $hargaTotal  = $request->harga_total;

        // Simpan ke tabel barang_masuk (history)
        BarangMasuk::create([
            'no_pemasukan' => $noPemasukan,
            'nama_barang'  => $namaBarang,
            'category_id'  => $categoryId,
            'stock'        => $stockTambah,
            'satuan'       => $satuan,
            'harga_total'  => $hargaTotal,
        ]);

        // Update / Create produk di tabel products
        $product = Product::where('nama_barang', $namaBarang)
                          ->where('category_id', $categoryId)
                          ->first();

        if ($product) {
            $product->stock += $stockTambah;
            $product->harga_total += $hargaTotal;
            $product->save();
        } else {
            Product::create([
                'no_pemasukan' => $noPemasukan,
                'nama_barang'  => $namaBarang,
                'category_id'  => $categoryId,
                'stock'        => $stockTambah,
                'satuan'       => $satuan,
                'harga_total'  => $hargaTotal,
            ]);
        }

        return redirect()->route('barangmasuk.create')->with('success', 'Barang masuk berhasil ditambahkan.');
    }
}
