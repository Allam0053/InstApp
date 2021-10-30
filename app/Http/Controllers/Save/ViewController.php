<?php

namespace App\Http\Controllers\Save;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $saved_list = Saved::select('id_post')->get();
        $savedPosts = [];

        foreach ($saved_list as $saved) {
            $post = Post::where('id', $saved->id_post)->first();
            array_push($savedPosts, $post);
        }

        return view('saved', compact(['savedPosts']));
    }
}
