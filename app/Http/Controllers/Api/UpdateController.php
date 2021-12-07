<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatContent;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\UserChat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function posting(Request $r, $id)
    {
        $post = Post::where('id', $id)->first();
        $post_foto = $post->foto;
        $post_caption = $post->caption;
        try {
            $post->update([
                'foto' =>  $this->saveFoto($r, $post->id),
                'caption' => $r->caption,
                'sentiment' => $r->sentiment
            ]);

            if ($post->foto == 'unknown file extension')
                throw new Exception('unknown file extension');
            return $this->sendResponse($post->foto, asset('storage') . '/');
        } catch (Exception $e) {
            $post->update([
                'foto' => $post_foto,
                'caption' => $post_caption
            ]);
            return $this->sendResponse('failed adding', $e->message);
        }
    }

    public function profile(Request $r)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->update($r->all());
        return $this->sendResponse($user, asset('storage') . '/');
    }

    public function editComment(Request $r, $id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->update($r->all());
        return $this->sendResponse($comment, asset('storage') . '/');
    }

    public function invitePeople(Request $r)
    {
        $userchat = UserChat::create([
            'id_chat' => $r->id_chat,
            'id_user' => $r->id_user
        ]);
        return $this->sendResponse($userchat, $userchat->user->name . ' now joined the group');
    }

    public function kickPeople(Request $r)
    {
        $userchat = UserChat::where([
            ['id_user', '=', $r->id_user],
            ['id_chat', '=', $r->id_chat]
        ]);
        $name = $userchat->user->name;
        $userchat->delete();
        return $this->sendResponse($userchat, $name . ' leave the group');
    }

    public function editChat(Request $r, $id)
    {
        $chatcontent = ChatContent::where('id', $id)->first();
        $chatcontent->update($r->all());
        return $this->sendResponse($chatcontent, 'edited chat');
    }
}
