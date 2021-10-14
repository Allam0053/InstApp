<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index() {
        $posts = Post::paginate(10);
        return view('front', compact(['posts']));
    }

    public function view($id) {
        $post = Post::findOrFail($id);
        return view('view-post', compact('post'));
    }
}
