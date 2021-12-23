<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Chat;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function getActiveChat()
    {
        $userChat = UserChat::where('id_user', Auth::id())->get()->first();
        if ($userChat == null) {
            return redirect()->route('chat.create.get');
        } else {
            $id = $userChat->id_chat;
            return redirect()->route('chat', [$id]);
        }
    }

    public function index($active = 0)
    {
        $user = User::findOrFail(Auth::user()->id);
        $active_chat = Chat::where('id', $active)->get()->first();

        if ($active_chat == null) return redirect('/');
        if (!$this->authChat($user, $active_chat))
            return redirect()->route('home')->with('forbidden', 'You are not allowed to view it');
        return view('chat', compact(['user', 'active', 'active_chat']));
    }

    public function authChat($user, $active_chat): bool
    {
        foreach ($active_chat->user as $member) {
            if ($member->id == $user->id) return true;
        }
        return false;
    }

    public function showForm()
    {
        $users = User::all();
        return view('chat-new', compact(['users']));
    }
}
