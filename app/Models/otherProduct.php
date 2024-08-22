<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otherProduct extends Model
{
    use HasFactory;
    protected $table = 'other_products';
    protected $fillable = ['id', 'nama_produk', 'keterangan', 'icon', 'status'];
}
