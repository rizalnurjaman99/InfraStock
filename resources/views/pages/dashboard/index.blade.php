@extends('layouts.main')

@section('content')
<div class="container">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Dashboard</h2>
        
        <form action="{{ route('dashboard') }}" method="GET" 
            class="d-flex" 
            style="max-width: 400px; margin-right: 10px;">
            <input 
                type="text" 
                name="search" 
                class="form-control mr-2" 
                placeholder="Cari barang atau kategori..." 
                value="{{ request('search') }}"
                style="border-radius: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <button class="btn btn-outline-primary" type="submit" style="border-radius: 100px;">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Harga Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $index }}</td>
                            <td>{{ $product->nama_barang }}</td>
                            <td>{{ $product->category->name ?? $product->category_name ?? '-' }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->satuan }}</td>
                            <td>Rp {{ number_format($product->harga_total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $products->links('pagination::bootstrap-4') }}
</div>

@endsection
