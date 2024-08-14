<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubKategoriModel extends Model
{
    use HasFactory;

    protected $table = 'sub_sub_kategori';
    protected $fillable = ['id_kat','id_sub','id_sub_sub','nama_sub_sub_kategori'];
}
