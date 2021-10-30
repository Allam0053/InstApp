<?php

namespace App\Http\Controllers\Save;

use App\Http\Controllers\Controller;
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

        return view('front', compact(['posts']));
    }
}
