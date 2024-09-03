<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['id','nama_kategori'];

    public function product()
    {
        return $this->hasMany(ProductModel::class, 'id_kategori', 'id');
    }
}
