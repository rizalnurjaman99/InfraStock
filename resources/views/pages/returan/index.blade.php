@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Daftar Returan</h4>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('returan.create') }}" class="btn btn-primary mb-3">+ Tambah Returan</a>

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

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $returan->links() }}
    </div>
</div>
@endsection
