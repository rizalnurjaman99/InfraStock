<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturanTable extends Migration
{
    public function up(): void
    {
        Schema::create('returan', function (Blueprint $table) {
            $table->id();
            $table->string('no_permintaan'); // foreign-like ke tabel permintaan
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('harga'); // harga satuan
            $table->string('dari_cabang'); // otomatis dari tujuan_alokasi permintaan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('returan');
    }
}
