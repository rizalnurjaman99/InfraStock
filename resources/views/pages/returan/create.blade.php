@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Tambah Returan</h4>
        <div class="card">
          <div class="card-body">
            <form action="{{ route('returan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>No Permintaan</label>
                    <input list="listPermintaan" id="no_permintaan" name="no_permintaan" class="form-control" placeholder="Ketik No Permintaan..." required>
                    
                    <datalist id="listPermintaan">
                        @foreach($permintaan as $p)
                            <option 
                                value="{{ $p->no_permintaan }}" 
                                data-nama="{{ $p->nama_barang }}"
                                data-cabang="{{ $p->tujuan_alokasi }}"
                                data-qty="{{ $p->qty }}">
                                {{ $p->no_permintaan }} - {{ $p->nama_barang }} (Qty: {{ $p->qty }})
                            </option>
                        @endforeach
                    </datalist>
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
                    <input type="number" id="jumlah" name="jumlah" class="form-control" required min="1">
                    <small id="qty-info" class="text-muted"></small>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    let permintaanData = {};

                    // Ambil semua data permintaan ke dalam objek JS
                    @foreach($permintaan as $p)
                        permintaanData["{{ $p->no_permintaan }}"] = {
                            nama_barang: "{{ $p->nama_barang }}",
                            cabang: "{{ $p->tujuan_alokasi }}",
                            qty: {{ $p->qty }}
                        };
                    @endforeach

                    // Ketika input No Permintaan berubah
                    $('#no_permintaan').on('input', function() {
                        const kode = $(this).val();
                        const data = permintaanData[kode];

                        if (data) {
                            $('#nama_barang').val(data.nama_barang);
                            $('#dari_cabang').val(data.cabang);
                            $('#qty-info').text('Qty Permintaan: ' + data.qty);
                            $('#jumlah').attr('max', data.qty);
                        } else {
                            $('#nama_barang').val('');
                            $('#dari_cabang').val('');
                            $('#qty-info').text('');
                            $('#jumlah').removeAttr('max');
                        }

                        $('#jumlah').val('').removeClass('is-invalid');
                    });

                    // Validasi jumlah tidak melebihi qty permintaan
                    $('#jumlah').on('input', function() {
                        const kode = $('#no_permintaan').val();
                        const data = permintaanData[kode];
                        const val = parseInt($(this).val());

                        if (data && val > data.qty) {
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });
                </script>

                <style>
                    .is-invalid {
                        border: 2px solid red !important;
                        background-color: #ffe6e6;
                    }
                </style>
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
    </div>
</div>
@endsection
