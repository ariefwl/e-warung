<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategoriModel extends Model
{
    use HasFactory;
    protected $table = 'sub_kategori';
    protected $fillable = ['id','id_sub','nama_sub_kategori'];
}
