<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\History;
use App\Product;
use App\BarangMasuk;
use App\Category;
use App\Returan;
use App\Permintaan;
use Illuminate\Http\Request;


class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $history = History::when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%");
            })
            ->orderBy('nama_barang', 'asc')
            ->paginate(20)
            ->appends(['search' => $search]);

        return view('pages.history.index', compact('history', 'search'));

    }
}
