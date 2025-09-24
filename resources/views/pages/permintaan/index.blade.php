@extends('layouts.main')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4>Daftar Permintaan</h4>
    <a href="{{ route('permintaan.create') }}" class="btn btn-primary mb-3">Tambah</a>

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

    {{ $permintaan->links() }}
</div>
@endsection
