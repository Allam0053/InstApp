<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'like';
    protected $fillable = [
        'id_user',
        'id_post',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    
    public function post() {
        return $this->belongsTo(Post::class, 'id_post', 'id');
    }
}
