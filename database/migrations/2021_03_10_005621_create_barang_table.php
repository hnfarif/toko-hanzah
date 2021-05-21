<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->unique();
            $table->integer('stock');
            $table->string('satuan');
            $table->integer('harga_satuan_beli');
            $table->integer('harga_satuan_jual')->default(null);
            $table->integer('total_harga_beli');
            $table->integer('total_harga_jual')->default(null);
            $table->string('gambar_barang')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
