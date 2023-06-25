<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    
    protected $fillable = [
        'id_chat',
        'id_user',
        'chat_message',
        'chat_time',
        'status_read' 
    ];
   
    protected $primaryKey = 'id_chat';
    protected $keyType = 'string';
}