<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function store(Request $request) {
        $comment = Comment::findOrFail($request->id_comment);

        if ($request->comment != '') {
            $comment->update([
                'isi' => $request->comment
            ]);
        } else {
            $comment->delete();
        }
        return redirect()->route('post.view', ['id' => $request->id_post])->with('success', 'Berhasil Mengubah Komen');
    }
}
