<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index($active = 0) {
        $user = User::findOrFail( Auth::user()->id );
        $active_chat = Chat::where('id', $active)->get()->first();
        return view('chat', compact(['user', 'active', 'active_chat']));
    }

    public function showForm() {
        $users = User::all();
        return view('chat-new', compact(['users']));
    }
}
