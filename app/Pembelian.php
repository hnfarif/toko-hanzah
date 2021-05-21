<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $fillable = ['nama_barang', 'nama_toko', 'tangal_beli', 'jumlah', 'satuan', 'harga_satuan','total'];
}
