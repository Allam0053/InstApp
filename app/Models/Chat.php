<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chat';
    protected $fillable = [
        'id'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'userchat', 'id_chat', 'id_user', 'id', 'id');
    }

    public function chat_content()
    {
        return $this->chatContent();
    }
    // alias
    public function chatContent()
    {
        return $this->hasMany(ChatContent::class, 'id_chat');
    }

    public function user_chat()
    {
        return $this->hasMany(UserChat::class, 'id_chat', 'id');
    }
}
