<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
