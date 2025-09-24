<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('pages.barang.create', compact('categories'));
    }

// Simpan Barang Masuk ke database
    public function store(Request $request)
    {
        $request->validate([
            'no_pemasukan' => 'required',
            'nama_barang' => 'required',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric',
        ]);

        // Hitung total harga
        $harga_total = $request->stock * $request->harga_satuan;
        // Cek apakah barang sudah ada sebelumnya
        $product = Product::where('nama_barang', $request->nama_barang)
                        ->where('category_id', $request->category_id)
                        ->first();

        if ($product) {
            // Jika barang sudah ada, update stock + harga_total
            $product->stock += $request->stock;
            $product->harga_total += $harga_total;
            $product->save();
        } else {
            // Jika barang baru, buat data baru
            Product::create([
                'no_pemasukan' => $request->no_pemasukan,
                'name' => $request->nama_barang,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'satuan' => $request->satuan,
                'harga_satuan' => $request->harga_satuan,
                'harga_total' => $harga_total,
                'created_by' => Auth::user()->name,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

}