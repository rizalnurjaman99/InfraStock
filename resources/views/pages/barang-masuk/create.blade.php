@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Tambah Barang Masuk</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('barangmasuk.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>No Pemasukan</label>
            <input type="text" name="no_pemasukan" class="form-control" value="{{ old('no_pemasukan') }}">
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required value="{{ old('nama_barang') }}">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock') }}">
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required value="{{ old('satuan') }}">
        </div>

        <div class="form-group">
            <label>Harga Total</label>
            <input type="number" name="harga_total" class="form-control" required value="{{ old('harga_total') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
