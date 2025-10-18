@extends('layouts.main')

@section('content')
<div class="container">
    <h4>Tambah Permintaan</h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permintaan.store') }}" method="POST">
            @csrf

                <div class="form-group">
                    <label>User <small>(contoh: Rizal-Marketing)</small></label>
                    <input type="text" name="user" class="form-control" required value="{{ old('user') }}">
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input list="listBarang" id="nama_barang" name="nama_barang" class="form-control" placeholder="Ketik nama barang..." required>
                    <datalist id="listBarang">
                        @foreach($products as $p)
                            <option value="{{ $p->nama_barang }}" data-stock="{{ $p->stock }}">
                                {{ $p->nama_barang }} (Stok: {{ $p->stock }})
                            </option>
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group">
                    <label>Qty</label>
                    <input type="number" id="qty" name="qty" class="form-control" required value="{{ old('qty') }}" min="1">
                    <small id="stok-info" class="text-muted"></small>
                </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        let stockData = {};
                        // Ambil data stok dari datalist
                        @foreach($products as $p)
                        stockData["{{ $p->nama_barang }}"] = {{ $p->stock }};
                        @endforeach
                        $('#nama_barang').on('input', function() 
                        {
                            const nama = $(this).val();
                            const stok = stockData[nama] ?? null;

                            if (stok !== null) {
                                $('#stok-info').text('Stok tersedia: ' + stok);
                                $('#qty').attr('max', stok);
                                }
                            else {
                                $('#stok-info').text('');
                                $('#qty').removeAttr('max');
                                }

                                $('#qty').val(''); // reset qty tiap ganti barang
                        });

                            $('#qty').on('input', function() {
                                const nama = $('#nama_barang').val();
                                const stok = stockData[nama] ?? null;
                                const qty = parseInt($(this).val());

                                if (stok !== null && qty > stok) {
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
                    <input type="text" name="satuan" class="form-control" required value="{{ old('satuan') }}">
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
                </div>

                <div class="form-group">
                    <label>Tujuan Alokasi</label>
                    <input type="text" name="tujuan_alokasi" class="form-control" required value="{{ old('tujuan_alokasi') }}">
                </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
</div>
        @endsection
