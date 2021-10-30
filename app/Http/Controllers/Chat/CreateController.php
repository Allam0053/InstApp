<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\UserChat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function store(Request $r)
    {
        $members_id = $this->getMemberId($r->member);
        $chat = Chat::create();

        foreach ($members_id as $member_id) {
            UserChat::create([
                'id_chat' => $chat->id,
                'id_user' => $member_id
            ]);
        }

        $creatorId = Auth::id();
        // TODO : check user add themself or not
        UserChat::create([
            'id_chat' => $chat->id,
            'id_user' => $creatorId
        ]);

        return redirect()->route('chat', ['active' => $chat->id]);
    }

    public function getMemberId($str): array
    {
        $str = preg_replace('#\s+#', ',', trim($str));
        $to_arr = '[' . $str . ']';
        $arr = json_decode($to_arr);
        return $arr;
    }
}
