<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    /** route /foto METHOD GET
     * return array of image link
     * enjoy the photos
     */
    public function getAll()
    {
        $posts = Post::where('foto', 'NOT LIKE', 'http%')->orderBy('id', 'DESC')->get();
        return $this->sendResponse($posts, asset('storage') . '/');
    }

    public function getAllPosts()
    {
        $posts = Post::where('foto', 'NOT LIKE', 'http%')->orderBy('id', 'DESC')->get();
        foreach ($posts as $post) {
            $post->user;
        }
        return $this->sendResponse($posts, asset('storage') . '/');
    }

    public function getProfile()
    {
        if (!Auth::guard('api')->check())
            return $this->sendResponse(null, 'user not logged in.');
        return $this->sendResponse(Auth::guard('api')->user(), asset('storage') . '/');
    }

    public function getProfileById($id)
    {
        $user = User::where('id', $id)->first();
        return $this->sendResponse($user, asset('storage') . '/');
    }
}
