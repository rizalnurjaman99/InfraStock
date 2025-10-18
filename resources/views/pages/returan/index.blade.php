@extends('layouts.main')

@section('content')
    <div class="container">    
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Daftar Returan</h4>
            <form action="{{ route('returan') }}" method="GET" class="d-flex mx-auto" style="max-width: 400px;">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control mr-2" 
                    placeholder="Cari Sesuatu..." 
                    value="{{ request('search') }}"
                    style="border-radius: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <button class="btn btn-outline-primary" type="submit" style="border-radius: 20px;">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <a href="{{ route('returan.create') }}" class="btn btn-primary">Tambah</a>
        </div>
            {{-- Flash message --}}
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Permintaan</th>
                        <th>Nama Barang</th>
                        <th>Dari Cabang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga (Satuan)</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($returan as $r)
                        <tr>
                            <td>{{ $loop->iteration + ($returan->currentPage()-1) * $returan->perPage() }}</td>
                            <td>{{ $r->no_permintaan }}</td>
                            <td>{{ $r->nama_barang }}</td>
                            <td>{{ $r->dari_cabang }}</td>
                            <td>{{ $r->jumlah }}</td>
                            <td>{{ $r->satuan }}</td>
                            <td>Rp {{ number_format($r->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($r->harga * $r->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('returan.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data returan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

        </div>
    </div>
</div>
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $returan->links('pagination::bootstrap-4') }}
</div>
@endsection
