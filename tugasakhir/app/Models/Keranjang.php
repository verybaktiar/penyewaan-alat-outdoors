<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjangs';
    
    protected $fillable = [
        'id_keranjang',
        'id_pelanggan',
        'id_alatoutdoor',
        'mulai_sewa',
        'akhir_sewa',
        'total_sewa' 
    ];
   
    protected $primaryKey = 'id_keranjang';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
    }

    public function alatoutdoor(){
        return $this->belongsTo(Alatoutdoor::class, 'id_alatoutdoor','id_alatoutdoor');
    }
    
    protected $keyType = 'string';
}