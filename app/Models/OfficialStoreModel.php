<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialStoreModel extends Model
{
    use HasFactory;
    protected $table = 'official_store';
    protected $fillable = ['id','nama_store','keterangan','image','link_facebook','link_x','status'];
}
