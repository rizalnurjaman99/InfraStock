<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'no_pemasukan',
        'nama_barang',
        'category_id',
        'stock',
        'satuan',
        'harga_total',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
