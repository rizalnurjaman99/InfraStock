@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Tambah Permintaan</h4>

    <form action="{{ route('permintaan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>User <small>(contoh: Rizal-Marketing)</small></label>
            <input type="text" name="user" class="form-control" required value="{{ old('user') }}">
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required value="{{ old('nama_barang') }}">
        </div>

        <div class="form-group">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" required value="{{ old('qty') }}">
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required value="{{ old('satuan') }}">
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
        </div>

        <div class="form-group">
            <label>Tujuan Alokasi</label>
            <input type="text" name="tujuan_alokasi" class="form-control" required value="{{ old('tujuan_alokasi') }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
