<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver',
        'content',
    ];

    // Relación con el usuario que envía el mensaje
    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    // Relación con el usuario que recibe el mensaje
    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}