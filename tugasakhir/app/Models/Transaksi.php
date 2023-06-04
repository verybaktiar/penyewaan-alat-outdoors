<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    
    protected $fillable = [
        'id_transaksi',
        'id_pelanggan',
        'list_id_keranjang',
        'jaminan',
        'foto_jaminan',
        'bukti_bayar'
    ];
   
    protected $primaryKey = 'id_transaksi';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
    }
    
    protected $keyType = 'string';
}