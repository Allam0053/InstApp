<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follow';
    protected $fillable = [
        'id_user',
        'follower'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function follower() {
        return $this->belongsTo(User::class, 'follower');
    }
}
