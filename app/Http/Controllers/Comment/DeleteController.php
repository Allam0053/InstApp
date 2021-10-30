<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deleteComment($id)
    {
        $message = $this->deleteData('comment', $id);
        return redirect()->back()->with('message', $message);
    }

    public function authUser($id_comment): bool
    {
        $comment = Comment::where('id', $id_comment)->where('id_user', Auth::id())->get()->first();
        if ($comment) return true;
        return false;
    }
}
