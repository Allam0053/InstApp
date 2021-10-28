<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function store(Request $request) {
        $like = Like::where('id_post', $request->id_post)
                    ->where('id_user', $request->id_user)->first();
        if (!$like) {
            Like::create([
                'id_post' => $request->id_post,
                'id_user' => $request->id_user
            ]);
        } else {
            $like->delete();
        }
        return redirect()->back();
    }
}
