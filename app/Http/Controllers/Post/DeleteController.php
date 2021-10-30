<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deletePost($id)
    {
        $message = $this->deleteData('post', $id);
        return redirect()->back()->with('message', $message);
    }
}
