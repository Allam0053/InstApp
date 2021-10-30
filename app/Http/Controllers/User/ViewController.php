<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index () {
        $posts = Post::where('id_user', Auth::user()->id)->get();
        return view('profile', compact('posts'));
    }
}
