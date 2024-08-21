<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanModel extends Model
{
    use HasFactory;
    protected $table = 'iklan';
    protected $fillable = ['id', 'judul_iklan', 'image', 'status'];
}
