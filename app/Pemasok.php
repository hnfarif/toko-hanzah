<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    protected $table = 'pemasok';
    protected $fillable = ['nama_pemasok','alamat_pemasok','no_hp'];
}
