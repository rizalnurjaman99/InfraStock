@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Barang Masuk</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcumb-item active">/Produk</a></li>
        </ol>
    </div>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col">

            {{-- @if (@errors->any())
                
            @endif --}}

            <form action="/products/store" method="POST">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                       <div class="form-group">
                           <label for="name" class="form-label">Nama Produk</label>
                           <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                           @error('name')
                               <span class="invalid-feedback">{{ $message }}</span>
                           @enderror
                       </div>
                       <div class="form-group">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" cols="5" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror</div>
                       <div class="form-group">
                            <label for="sku" class="form-label">Kode Produk</label>
                            <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}">
                            @error('sku')
                               <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group">
                            <label for="price" class="form-label">Harga Satuan</label>
                            <input type="number" inputmode="numeric" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price')
                               <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group">
                            <label for="stock" class="form-label">Stock Barang</label>
                            @error('stock')
                               <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                       </div>
                       <div class="form-group">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                               <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                       </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/products" class="btn btn-sm btn-outline-secondary mr-2">Batal</a>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection