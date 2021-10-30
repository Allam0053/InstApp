<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deletePost($id)
    {
        if (!$this->authUser($id)) return redirect()->back()->with('message', $actionNotAllowed);
        $message = $this->deleteData('post', $id);
        return redirect()->back()->with('message', $message);
    }

    /**
     * if the poster then allow to delete
     */
    public function authUser($id_post): bool
    {
        $post = Post::where('id', $id_post)->get()->first();
        if ($post->id_user == Auth::id()) return true;
        return false;
    }
}
