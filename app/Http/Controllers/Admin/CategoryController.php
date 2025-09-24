<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store (Request $request)
    {
        $validateData = $request->validate([
            "name" => "required|unique:categories,name",
        ],
        [
            "name.required" => "Nama Kategori Harus Diisi!",
            "name.unique" => "Nama Kategori Sudah Ada!",
        ]);
        
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->save(); // simpan ke database

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect('/categories');
    }
}
