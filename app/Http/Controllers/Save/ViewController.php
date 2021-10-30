<?php

namespace App\Http\Controllers\Save;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index()
    {
        // $saved_list = Saved::select('id_post')->get();
        // $posts = new Collection();

        // foreach ($saved_list as $saved) {
        //     $post = Post::where('id', $saved->id_post)->first();
        //     $posts->push($post);
        // }


        $user = User::where('id', Auth::id())->get()->first();
        $posts = $user->saved_post;
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
