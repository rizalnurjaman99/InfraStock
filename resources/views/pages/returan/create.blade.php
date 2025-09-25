@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Tambah Returan</h4>

    <form action="{{ route('returan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>No Permintaan</label>
            <select name="no_permintaan" class="form-control" required onchange="setPermintaanData(this)">
                <option value="">-- Pilih No Permintaan --</option>
                @foreach($permintaan as $p)
                    <option value="{{ $p->no_permintaan }}"
                            data-nama="{{ $p->nama_barang }}"
                            data-cabang="{{ $p->tujuan_alokasi }}">
                        {{ $p->no_permintaan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label>Dari Cabang</label>
            <input type="text" name="dari_cabang" id="dari_cabang" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required min="1">
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Harga (per satuan)</label>
            <input type="number" name="harga" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('returan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function setPermintaanData(select) {
    const nama = select.options[select.selectedIndex].getAttribute('data-nama');
    const cabang = select.options[select.selectedIndex].getAttribute('data-cabang');

    document.getElementById('nama_barang').value = nama || '';
    document.getElementById('dari_cabang').value = cabang || '';
}
</script>
@endsection
