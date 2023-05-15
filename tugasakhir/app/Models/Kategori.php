<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $fillable = [
        'id_kategori',
        'nama_kategori', 
    ];
   
    protected $primaryKey = 'id_kategori';
    protected $keyType = 'string';

    public function alatoutdoor()
    {
        return $this->hasMany(Alatoutdoor::class, 'id_kategori');
    }
    
}
