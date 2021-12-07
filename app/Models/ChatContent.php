<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatContent extends Model
{
    use HasFactory;
    protected $table = 'chatcontent';
    protected $timestamp = true;
    protected $fillable = [
        'content',
        'id_chat',
        'pengirim',
        'sentiment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pengirim');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }
}
