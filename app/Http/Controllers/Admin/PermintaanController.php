<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permintaan;
use App\Product;
use App\History;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index(Request $request)
    {
         $search = $request->input('search');

        $permintaan = Permintaan::when($search, function ($query, $search) {
            $query->where('no_permintaan', 'like', "%$search%")
                  ->orWhere('nama_barang', 'like', "%$search%");
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(15)
            ->appends(['search' => $search]);

        return view('pages.permintaan.index', compact('permintaan', 'search'));
    }

    public function create()
    {
        // Ambil semua barang dari dashboard (products)
        $products = Product::all();
        return view('pages.permintaan.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:1',
            'tujuan_alokasi' => 'required|string|max:255',
        ]);
        // Cek apakah barang tersedia di dashboard
        $product = Product::where('nama_barang', $request->nama_barang)->first();

        if (!$product) {
            return back()->with('error', 'Nama barang tidak ditemukan di dashboard!');
        }

        // Cek stok apakah cukup
        if ($request->jumlah > $product->stock) {
            return back()->with('error', 'Jumlah permintaan melebihi stok yang tersedia di dashboard!');
        }
        
        // buat no_permintaan otomatis YYMMDD + 3 digit urut
        $datePart = date('ymd');
        $last = Permintaan::where('no_permintaan', 'like', $datePart.'%')
                    ->orderBy('no_permintaan', 'desc')
                    ->first();

        $nextNo = $last ? intval(substr($last->no_permintaan, 6)) + 1 : 1;
        $noPermintaan = $datePart . str_pad($nextNo, 3, '0', STR_PAD_LEFT);

        // simpan
        Permintaan::create([
            'no_permintaan' => $noPermintaan,
            'user' => $request->user,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'tujuan_alokasi' => $request->tujuan_alokasi,
        ]);

        return redirect()->route('permintaan.index')
                         ->with('success', 'Berhasil membuat permintaan!');
    
        
    }

    public function destroy($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->delete();

        return redirect()->route('permintaan.index')
                         ->with('success', 'Permintaan berhasil dihapus dan stock di-update.');
    
    }
}
