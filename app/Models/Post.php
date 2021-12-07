<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = [
        'foto',
        'caption',
        'id_user',
        'sentiment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function comment()
    {
        return $this->hasMany(Comment::class, 'id_post', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'id_post', 'id');
    }

    public function saved_by()
    {
        return $this->savedBy();
    }
    public function savedBy()
    {
        return $this->belongsToMany(User::class, 'saved', 'id_post', 'id_user', 'id', 'id');
    }
}
