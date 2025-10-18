@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Permintaan</h4>

        <form action="{{ route('permintaan') }}" method="GET" class="d-flex mx-auto" style="max-width: 400px;">
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

        <a href="{{ route('permintaan.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="card">
    <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Permintaan</th>
                        <th>User</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Tujuan Alokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permintaan as $index => $p)
                    <tr>
                        <td>{{ $permintaan->firstItem() + $index }}</td>
                        <td>{{ $p->no_permintaan }}</td>
                        <td>{{ $p->user }}</td>
                        <td>{{ $p->nama_barang }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->tujuan_alokasi }}</td>
                        <td>
                            <form action="{{ route('permintaan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada permintaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $permintaan->links('pagination::bootstrap-4') }}
</div>
@endsection
