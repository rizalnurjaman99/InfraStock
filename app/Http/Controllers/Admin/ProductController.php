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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%");
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(15)
            ->appends(['search' => $search]);

    return view('pages.dashboard.index', compact('products', 'search'));
    
    }

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
        'category_id' => 'required|exists:categories,id',
        'stock' => 'required|numeric|min:1',
        'satuan' => 'required|string',
        'harga_satuan' => 'required|numeric|min:0',
    ]);

    // Simpan nama kategori agar tidak hilang jika kategori dihapus
    $category = Category::find($request->category_id);
    $categoryName = $category ? $category->name : 'Tanpa Kategori';

    // Hitung total harga
    $harga_total = $request->stock * $request->harga_satuan;

    // Cek apakah barang dengan kategori sama sudah ada
    $product = Product::where('nama_barang', $request->nama_barang)
                    ->where('category_id', $request->category_id)
                    ->first();

    if ($product) {
        // Jika barang sudah ada, tambahkan stock dan harga_total
        $product->stock += $request->stock;
        $product->harga_total += $harga_total;
        $product->save();
    } else {
        // Jika barang baru, buat data baru
        Product::create([
            'no_pemasukan' => $request->no_pemasukan,
            'nama_barang' => $request->nama_barang,
            'category_id' => $request->category_id,
            'category_name' => $categoryName,
            'stock' => $request->stock,
            'satuan' => $request->satuan,
            'harga_total' => $harga_total,
        ]);
    }

    return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
}

}
