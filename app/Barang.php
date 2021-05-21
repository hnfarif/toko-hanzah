<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'stock', 'satuan', 'harga_satuan_beli','total_harga_beli'];
    protected $nullable = ['harga_satuan_jual','total_harga_jual','gambar_barang'];
}
