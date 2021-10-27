<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatContent extends Model
{
    use HasFactory;
    protected $table = 'chatcontent';
    protected $fillable = [
        'content',
        'id_chat',
        'pengirim'
    ];

    public function pengirim() {
        return $this->belongsTo(User::class, 'pengirim');
    }

    public function chat() {
        return $this->belongsTo(Chat::class, 'id_chat');
    }
}
