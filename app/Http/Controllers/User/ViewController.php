<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        $posts = Post::where('id_user', Auth::user()->id)->get();
        return view('profile', compact('posts'));
    }

    public function get($id)
    {
        if (Auth::id() != $id) {
            redirect()->route('profile');
        }
        // This can be change to use join
        $user = User::where('id', $id)->get()->first();
        $follow = Follow::where([['id_user', $id], ['follower', Auth::id()]])->get()->first();
        $isFollow = false;
        if ($follow === null) {
            $isFollow = true;
        }
        $posts = Post::where('id_user', $id)->get();
        return view('profile-get', compact('user', 'posts', 'isFollow'));
    }
}
