<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deletePhotoFromApi($id)
    {
        $post = Post::findOrFail($id)->delete();
        return $this->sendResponse('image ' . $id . ' deleted', 'success deleted image');
    }
}
