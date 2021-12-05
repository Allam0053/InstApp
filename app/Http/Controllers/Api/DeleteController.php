<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deletePhotoFromApi($id)
    {
        $post = Post::findOrFail($id)->delete();
        return $this->sendResponse('image ' . $id . ' deleted', 'success deleted image');
    }

    public function posting($id)
    {
        $post = Post::findOrFail($id);
        if (Auth::user()->id == $post->id) $post->delete();
        else return $this->sendResponse('you are not allowed to delete this photo #' . $id, 'failed to delete post');
        return $this->sendResponse('post ' . $id . ' deleted', 'success deleted post');
    }
}
