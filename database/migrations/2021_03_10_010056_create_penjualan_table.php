<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('nama_barang');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('harga_satuan');
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
        Schema::dropIfExists('penjualan');
    }
}
