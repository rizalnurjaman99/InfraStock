<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Returan;
use App\Permintaan;
use App\Product;
use App\History;
use Illuminate\Support\Facades\Auth;

class ReturanController extends Controller
{
    public function index(Request $request)
    {
         $search = $request->input('search');

        $returan = Returan::when($search, function ($query, $search) {
            $query->where('no_permintaan', 'like', "%$search%")
                  ->orWhere('nama_barang', 'like', "%$search%");
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(15)
            ->appends(['search' => $search]);

        return view('pages.returan.index', compact('returan', 'search'));
    }

    public function create()
    {
        $permintaan = Permintaan::all(); // untuk dropdown No Permintaan
        return view('pages.returan.create', compact('permintaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_permintaan' => 'required|exists:permintaan,no_permintaan',
            'nama_barang'   => 'required|string',
            'jumlah'        => 'required|integer|min:1',
            'satuan'        => 'required|string',
            'harga'         => 'required|integer|min:1',
            'dari_cabang'   => 'required|string',
        ]);

        // Simpan data returan
        $returan = Returan::create([
            'no_permintaan' => $request->no_permintaan,
            'nama_barang'   => $request->nama_barang,
            'jumlah'        => $request->jumlah,
            'satuan'        => $request->satuan,
            'harga'         => $request->harga,
            'dari_cabang'   => $request->dari_cabang,
        ]);

        // Tambahkan kembali ke stok products
        $product = Product::where('nama_barang', $request->nama_barang)->first();
        if ($product) {
            $product->stock += $request->jumlah;
            $product->harga_total += ($request->harga * $request->jumlah);
            $product->save();
        }

        return redirect()->route('returan.index')->with('success', 'Returan berhasil ditambahkan!');
        History::create([
            'user' => Auth::user()->user_id,
            'aktivitas' => 'Tambah Returan',
            'deskripsi' => "Returan {$request->nama_barang} sebanyak {$request->jumlah} {$request->satuan}"
        ]);
}

    public function destroy($id)
    {
        $returan = Returan::findOrFail($id);

        // Balikkan lagi pengurangan dari product
        $product = Product::where('nama_barang', $returan->nama_barang)->first();
        if ($product) {
            $product->stock -= $returan->jumlah;
            $product->harga_total -= ($returan->harga * $returan->jumlah);
            $product->save();
        }

        $returan->delete();

        return redirect()->route('returan.index')->with('success', 'Returan berhasil dihapus!');
    
        History::create([
            'user' => Auth::user()->user_id,
            'aktivitas' => 'Hapus Returan',
            'deskripsi' => "Returan {$request->nama_barang} sebanyak {$request->jumlah} {$request->satuan}"
        ]);
    }
}
