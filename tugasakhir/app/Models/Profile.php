<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'user_comments';
    
    protected $fillable = [
        'id_comment',
        'id_pelanggan',
        'message_comment'
    ];
   
    protected $primaryKey = 'id_comment';

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
    }
    
    protected $keyType = 'string';
}