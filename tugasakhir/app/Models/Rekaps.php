<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekaps extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_rekap',
        'id_pelanggan',
        'id_alatoutdoor',
        'masa_sewa',
        'tgl_penyewaan',
        'tgl_pengembalian',
        'status_kembali',
        'denda',
        'id_admin' 
    ];
   
    protected $primaryKey = 'id_rekap';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');

}
    public function alatoutdoor(){
        return $this->belongsTo(Alatoutdoor::class, 'id_alatoutdoor','id_alatoutdoor');
}
    public function admin(){
         return $this->belongsTo(Admin::class, 'id_admin','id_admin');
}

    protected $keyType = 'string';
}