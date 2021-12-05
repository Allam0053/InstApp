<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; //PassportHasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'mobile',
        'city',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'id_user', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'id_user', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'id_user', 'id');
    }

    public function chat()
    {
        return $this->belongsToMany(Chat::class, 'userchat', 'id_user', 'id_chat', 'id', 'id');
    }

    // have alias
    public function saved_post()
    {
        return $this->savedPost();
    }
    public function savedPost()
    {
        return $this->belongsToMany(Post::class, 'saved', 'id_user', 'id_post', 'id', 'id');
    }
}
