<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
            $table->unsignedBigInteger('id_toko');
            $table->foreign('id_toko')->references('id')->on('pemasok')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('nama_toko');
            $table->date('tanggal_beli');
            $table->integer('jumlah');
            $table->integer('jumlah_pcs')->nullable();
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->string('total');
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
        Schema::dropIfExists('pembelian');
    }
}
