<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deleteChat($id)
    {
        if (!$this->authUser($id)) return redirect()->back()->with('message', $actionNotAllowed);
        $message = $this->deleteData('chat', $id);
        return redirect()->back()->with('message', $message);
    }

    /**
     * if a member, then allow to delete
     */
    public function authUser($id_chat): bool
    {
        $userchat = UserChat::where('id_chat', $id_chat)
            ->where('id_user', Auth::id())
            ->get()
            ->first();
        if ($userchat) return true;
        return false;
    }
}
