<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $fillable = ['nama_pelanggan', 'nama_barang', 'tanggal', 'jumlah', 'satuan', 'harga_satuan','total'];
}
