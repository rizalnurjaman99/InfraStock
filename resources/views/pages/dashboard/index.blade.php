@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Dashboard</h4>

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
                            <td>{{ $product->category->name ?? '-' }}</td>
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
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
