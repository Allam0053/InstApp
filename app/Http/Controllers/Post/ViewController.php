<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        $posts = new LengthAwarePaginator($posts, $posts->count(), 10);

        $followings = Follow::where('follower', Auth::id())->get();
        $saveds = Saved::where('id_user', Auth::id())->get();
        foreach ($posts as $post) {
            foreach ($followings as $following) {
                if ($post->id_user == $following->id_user) $post->following = true;
            }

            foreach ($saveds as $saved) {
                if ($post->id == $saved->id_post) $post->saved = true;
            }

            if (substr($post->foto, 0, 4) != 'http') $post->foto = asset('storage') . '/' . $post->foto;
        }
        return view('front', compact(['posts', 'followings']));
    }

    public function view($id)
    {
        $posts = Post::where('id', $id)->get();
        $posts = new LengthAwarePaginator($posts, $posts->count(), 10);

        $followings = Follow::where('follower', Auth::id())->get();
        $saveds = Saved::where('id_user', Auth::id())->get();
        foreach ($posts as $post) {
            foreach ($followings as $following) {
                if ($post->id_user == $following->id_user) $post->following = true;
            }

            foreach ($saveds as $saved) {
                if ($post->id == $saved->id_post) $post->saved = true;
            }
        }

        return view('front', compact(['posts']));
    }

    public function viewMy()
    {
        $id_user = Auth::id();
        $posts = Post::where('id_user', $id_user)->get();
        $posts = new LengthAwarePaginator($posts, $posts->count(), 10);

        $followings = Follow::where('follower', Auth::id())->get();
        $saveds = Saved::where('id_user', Auth::id())->get();
        foreach ($posts as $post) {
            foreach ($followings as $following) {
                if ($post->id_user == $following->id_user) $post->following = true;
            }

            foreach ($saveds as $saved) {
                if ($post->id == $saved->id_post) $post->saved = true;
            }
        }

        return view('front', compact(['posts']));
    }
}
