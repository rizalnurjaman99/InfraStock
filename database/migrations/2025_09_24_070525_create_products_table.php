<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('no_pemasukan')->nullable(); 
            $table->string('nama_barang');      
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('category_name')->nullable();
            $table->integer('stock');
            $table->string('satuan');
            $table->decimal('harga_total', 15, 2);
            $table->timestamps();            
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
