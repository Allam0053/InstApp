<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserChat extends Pivot
{
    public $incrementing = true;
    public $timestamps = true;
    protected $table = 'userchat';
    protected $fillable = [
        'id_user',
        'id_chat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function chat() {
        return $this->belongsTo(Chat::class, 'id_chat');
    }

}
