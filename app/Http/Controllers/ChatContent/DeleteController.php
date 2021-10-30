<?php

namespace App\Http\Controllers\ChatContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteChatContent($id)
    {
        $message = $this->deleteData('chatcontent', $id);
        return redirect()->back()->with('message', $message);
    }
}
