<?php

namespace App\Http\Controllers\ChatContent;

use App\Http\Controllers\Controller;
use App\Models\ChatContent;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteChatContent($id)
    {
        if (!this->authUser($id)) return redirect()->back()->with('message', $actionNotAllowed);
        $message = $this->deleteData('chatcontent', $id);
        return redirect()->back()->with('message', $message);
    }

    public function authUser($id_chatcontent): bool
    {
        $chatcontent = ChatContent::where('id', $id_chatcontent)->where('id_user', Auth::id())->get()->first();
        if ($chatcontent) return true;
        return false;
    }
}
