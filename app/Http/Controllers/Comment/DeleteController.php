<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteComment($id)
    {
        $message = $this->deleteData('comment', $id);
        return redirect()->back()->with('message', $message);
    }
}
