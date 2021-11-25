<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    /** route /foto METHOD GET
     * return array of image link
     * enjoy the photos
     */
    public function getAll()
    {
        $posts = Post::where('foto', 'NOT LIKE', 'http%')->orderBy('id', 'DESC')->get();
        return $this->sendResponse($posts, asset('storage') . '/');
    }
}
