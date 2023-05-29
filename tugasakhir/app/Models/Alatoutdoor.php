<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Alatoutdoor extends Model
{
    use HasFactory;
    protected $table = 'alatoutdoors';
    protected $fillable = [
        'id_alatoutdoor',
        'nama_alat',
        'id_kategori',
        'spesifikasi',
        'deskripsi',
        'stok',
        'harga_sewa',
        'merk', 
        'image'
    ];
   
    protected $primaryKey = 'id_alatoutdoor';
    protected $keyType = 'string';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}