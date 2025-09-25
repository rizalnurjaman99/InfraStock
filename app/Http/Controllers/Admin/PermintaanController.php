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
    public function index()
    {
        $permintaan = Permintaan::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.permintaan.index', compact('permintaan'));
    }

    public function create()
    {
        return view('pages.permintaan.create');
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
    
        History::create([
            'user' => Auth::user()->user_id,
            'aktivitas' => 'Tambah Permintaan',
            'deskripsi' => "Permintaan {$request->nama_barang} sebanyak {$request->qty} {$request->satuan}"
        ]);
    }

    public function destroy($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->delete();

        return redirect()->route('permintaan.index')
                         ->with('success', 'Permintaan berhasil dihapus dan stock di-update.');
    
        History::create([
            'user' => Auth::user()->user_id,
            'aktivitas' => 'Hapus Permintaan',
            'deskripsi' => "Permintaan {$request->nama_barang} sebanyak {$request->qty} {$request->satuan}"
        ]);
    }
}
