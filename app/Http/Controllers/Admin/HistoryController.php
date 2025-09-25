<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\History;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::latest()->paginate(20);
        return view('pages.history.index', compact('history'));
    }
}
