@extends('layouts.main')

@section('content')
<div class="container">
    <h4>History Aktivitas</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

    {{ $history->links() }}
</div>
@endsection
