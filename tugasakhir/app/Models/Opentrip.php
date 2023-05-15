<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Opentrip extends Model
{
    use HasFactory;
    protected $table = 'opentrips';
    protected $fillable = [
        'id_opentrip',
        'nm_opentrip',
        'deskripsi',
        'fasilitas',
        'harga',
        'image'
    ];
   
    protected $primaryKey = 'id_opentrip';
    protected $keyType = 'string';
}
