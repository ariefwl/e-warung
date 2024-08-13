<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['id','id_kategori','idsub_kategori','nama_product','harga','keterangan','thumbnail','status'];
}
