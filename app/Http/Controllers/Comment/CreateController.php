<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function store (Request $request) {
        $comment = Comment::create([
            'isi' => $request->isi,
            'id_post' => $request->id_post,
            'id_user' => $request->id_user,
        ]);

        return redirect()->back();
    }
}
