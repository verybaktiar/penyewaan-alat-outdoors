<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_admin',
        'id_user',
        'nama_admin',
        'alamat',
        'no_Telp',   
    ];
    protected $primaryKey = 'id_admin';

    public function user(){
        return $this->belongsTo(User::class, 'id_user','id_user');
    }
    
    protected $keyType = 'string';
}


