<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returan extends Model
{
    protected $table = 'returan';

    protected $fillable = [
        'no_permintaan',
        'nama_barang',
        'jumlah',
        'satuan',
        'harga',
        'dari_cabang'
    ];
}
