<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sewa',
        'id_pelanggan',
        'id_keranjang',
        'detail_alatoutdoor',
        'masa_sewa',
        'tgl_penyewaan',  
        'tgl_ambil', 
        'tgl_haruskembali',
        'status_sewa',
        'jaminan',
        'foto_jaminan',
        'total',
        'bukti_bayar'
    ];
   
    protected $primaryKey = 'id_sewa';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
}
    public function keranjang(){
         return $this->belongsTo(Keranjang::class, 'id_keranjang','id_keranjang');
}
    protected $keyType = 'string';
}