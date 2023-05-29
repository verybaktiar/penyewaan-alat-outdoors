<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaans';
    protected $fillable = [
        'id_sewa',
        'id_pelanggan',
        'id_keranjang', 
        'tgl_ambil', 
        'jaminan',
        'foto_jaminan',
        'total_bayar',
        'bukti_bayar',
        'status_bayar',
        'status_sewa'
    ];
   
    protected $primaryKey = 'id_sewa';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
    }

    protected $keyType = 'string';
}