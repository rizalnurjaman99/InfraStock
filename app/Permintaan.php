<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Permintaan extends Model
{
    protected $table = 'permintaan';

    protected $fillable = [
        'no_permintaan',
        'user',
        'nama_barang',
        'qty',
        'satuan',
        'harga',
        'tujuan_alokasi',
    ];

    // Relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class, 'nama_barang', 'nama_barang');
    }

    // otomatis mengurangi stock & harga_total di product jika ada
    public static function boot()
    {
        parent::boot();

        static::created(function ($permintaan) {
            $product = Product::where('nama_barang', $permintaan->nama_barang)->first();
            if ($product) {
                $product->stock -= $permintaan->qty;
                $product->harga_total -= $permintaan->harga;
                $product->save();
            }
        });

        static::deleted(function ($permintaan) {
            $product = Product::where('nama_barang', $permintaan->nama_barang)->first();
            if ($product) {
                $product->stock += $permintaan->qty;
                $product->harga_total += $permintaan->harga;
                $product->save();
            }
        });
    }
}
