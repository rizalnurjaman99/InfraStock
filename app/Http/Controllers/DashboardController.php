<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate(10);
        return view('pages.dashboard.index', compact('products'));
    }
}
