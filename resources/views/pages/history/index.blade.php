@extends('layouts.main')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Apa yang Mereka Lakukan ?</h4>

    <form action="{{ route('history') }}" method="GET" class="d-flex mx-auto" style="max-width: 400px;">
        <input 
            type="text" 
            name="search" 
            class="form-control mr-2" 
            placeholder="Cari barang atau kategori..." 
            value="{{ request('search') }}"
            style="border-radius: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <button class="btn btn-outline-primary" type="submit" style="border-radius: 20px;">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<div class="card">
    <div class="card-body">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $h)
                        <tr>
                            <td>{{ $loop->iteration + ($history->currentPage() - 1) * $history->perPage() }}</td>
                            <td>{{ $h->user }}</td>
                            <td>{{ $h->aktivitas }}</td>
                            <td>{{ $h->deskripsi }}</td>
                            <td>{{ $h->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data history</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $history->links('pagination::bootstrap-4') }}
</div>
@endsection
