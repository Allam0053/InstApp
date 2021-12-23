<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatContent;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\UserChat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateController extends Controller
{
    /* to get full path add `
     * asset('storage') . '/' .
     * `
     * accept base64
     * route /upfoto METHOD POST
     * return link foto
    */
    public function upFoto(Request $request)
    {
        $post_id = 0;
        try {
            $user = User::where('email', 'camerapp@email.com')->get()->first();
            if (!$user) $user = $this->apiAccount();

            $post = Post::create([
                'caption' => $request->caption,
                'id_user' => $user->id
            ]);
            $post_id = $post->id;
            $post->update([
                'foto' => $this->saveFoto($request, $post->id)
            ]);
            return $this->sendResponse($post->foto, asset('storage') . '/');
        } catch (Exception $e) {
            Post::where('id', $post_id)->first()->delete($post_id);
            return $this->sendResponse('failed adding', $e->message);
        }
    }

    public function apiAccount()
    {
        $user = User::create([
            'name' => 'Camera App Api',
            'email' => 'camerapp@email.com',
            'password' => Hash::make('cameraku'),
            'avatar' => asset('storage') . '/' . 'default.png'
        ]);
        return $user;
    }

    public function posting(Request $r)
    {
        $post_id = 0;
        try {
            $post = Post::create([
                'caption' => $r->caption,
                'id_user' => Auth::guard('api')->user()->id,
                'sentiment' => $r->sentiment
            ]);
            $post_id = $post->id;
            $post->update([
                'foto' => $this->saveFoto($r, $post->id)
            ]);
            if ($post->foto == 'unknown file extension')
                throw new Exception('unknown file extension');
            return $this->sendResponse($post->foto, asset('storage') . '/');
        } catch (Exception $e) {
            $post = Post::where('id', $post_id)->first();
            if ($post != null) $post->delete();
            return $this->sendResponse('failed adding', $e->getMessage());
        }
    }

    public function liking($id)
    {
        try {
            $like = Like::where('id_post', $id)
                ->where('id_user', Auth::user()->id)->first();
            if (!$like) {
                Like::create([
                    'id_post' => $id,
                    'id_user' => Auth::user()->id
                ]);
                return $this->sendResponse('success liking post with id #' . $id, null);
            } else {
                $like->delete();
                return $this->sendResponse('success disliking post with id #' . $id, null);
            }
        } catch (Exception $e) {
            return $this->sendResponse('fail to like ' . $id, $e->getMessage());
        }
    }

    public function createComment(Request $r)
    {
        $comment = Comment::create([
            'isi' => $r->isi,
            'id_post' => $r->id_post,
            'id_user' => Auth::user()->id,
            'sentiment' => $r->sentiment
        ]);
        return $this->sendResponse($comment, 'commented post #' . $r->id_post);
    }

    public function createGroup(Request $r)
    {
        $chat = Chat::create();
        $creatorId = Auth::id();
        $members = $this->getMemberId($r->members);
        foreach ($members as $member) {
            if ($creatorId == $member) continue;
            $userchat = UserChat::create([
                'id_chat' => $chat->id,
                'id_user' => $member
            ]);
        }

        // TODO : check user add themself or not
        UserChat::create([
            'id_chat' => $chat->id,
            'id_user' => $creatorId
        ]);
        $chat->user;
        return $this->sendResponse($chat, 'success create group');
    }

    public function getMemberId($str): array
    {
        $str = preg_replace('#\s+#', ',', trim($str));
        $to_arr = '[' . $str . ']';
        $arr = json_decode($to_arr);
        return $arr;
    }

    public function sendChat(Request $r)
    {
        $chatcontent = ChatContent::create([
            'pengirim' => Auth::id(),
            'content' => $r->content,
            'id_chat' => $r->id_chat,
            'sentiment' => $r->sentiment
        ]);
        return $this->sendResponse($chatcontent, 'success send chat');
    }
}
