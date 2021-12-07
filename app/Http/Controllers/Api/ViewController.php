<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    /** route /foto METHOD GET
     * return array of image link
     * enjoy the photos
     */
    public function getAll()
    {
        $posts = Post::where('foto', 'NOT LIKE', 'http%')->orderBy('id', 'DESC')->get();
        return $this->sendResponse($posts, asset('storage') . '/');
    }

    public function getAllPosts()
    {
        $posts = Post::where('foto', 'NOT LIKE', 'http%')->orderBy('id', 'DESC')->get();
        foreach ($posts as $post) {
            $post->user;
        }
        return $this->sendResponse($posts, asset('storage') . '/');
    }

    public function getProfile()
    {
        if (!Auth::guard('api')->check())
            return $this->sendResponse(null, 'user not logged in.');
        return $this->sendResponse(Auth::guard('api')->user(), asset('storage') . '/');
    }

    public function getProfileById($id)
    {
        $user = User::where('id', $id)->first();
        return $this->sendResponse($user, asset('storage') . '/');
    }

    public function getPostById($id)
    {
        $post = Post::where('id', $id)->first();
        return $this->sendResponse($post, asset('storage') . '/');
    }

    public function getCommentByPostId($id)
    {
        $comments = Comment::where('id_post', $id)->get();
        foreach ($comments as $comment) {
            $comment->user;
        }
        return $this->sendResponse($comments, asset('storage') . '/');
    }

    public function getCommentByUserId($id)
    {
        $comments = Comment::where('id_user', $id)->get();
        foreach ($comments as $comment) {
            $comment->user;
        }
        return $this->sendResponse($comments, asset('storage') . '/');
    }

    public function getAllChat()
    {
        $userchats = UserChat::where('id_user', Auth::user()->id)->get();
        $chats = [];
        $it = 0;
        foreach ($userchats as $userchat) {
            $userchat->chat->user;
            $chats[$it++] = $userchat->chat;
        }
        return $this->sendResponse(['chats_id' => $chats], asset('storage') . '/');
    }

    public function getChatById($id)
    {
        $chat = Chat::where('id', $id)->first();
        $chat->user;
        return $this->sendResponse(['chats_id' => $chat], asset('storage') . '/');
    }
}
