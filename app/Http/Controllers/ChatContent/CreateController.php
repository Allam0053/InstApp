<?php

namespace App\Http\Controllers\ChatContent;

use App\Http\Controllers\Controller;
use App\Models\ChatContent;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    // buat pesan
    public function store(Request $r) {
        $chat_content = ChatContent::create([
            'pengirim' => $r->id_user,
            'id_chat' => $r->id_chat,
            'content' => $r->content,
        ]);
        return redirect()->back();
    }
}
