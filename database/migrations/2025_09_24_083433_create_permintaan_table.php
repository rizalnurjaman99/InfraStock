<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanTable extends Migration
{
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('no_permintaan')->unique();
            $table->string('user');
            $table->string('nama_barang');
            $table->integer('qty');
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->string('tujuan_alokasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan');
    }
}
