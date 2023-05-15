<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pelanggan',
        'id_user',
        'nama_pelanggan',
        'alamat',
        'no_telepon',
        'jenis_kelamin',   
    ];
   
    protected $primaryKey = 'id_pelanggan';

    public function user(){
        return $this->belongsTo(User::class, 'id_user','id_user');
}
    protected $keyType = 'string';

}
