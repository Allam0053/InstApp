<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $post->like_count = $post->like->count();
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
        $post->like_count = $post->like->count();
        return $this->sendResponse($post, asset('storage') . '/');
    }

    public function getFavouritesPosts()
    {
        $likes = Like::where('id_user', Auth::guard('api')->user()->id)->get();
        $favourites = [];
        foreach ($likes as $like) {
            $like->post->user;
            array_push($favourites, $like->post);
        }
        return $this->sendResponse($favourites, asset('storage') . '/');
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
        return $this->sendResponse($chats, asset('storage') . '/');
    }



    public function getChatById($id)
    {
        $chat = Chat::where('id', $id)->first();
        $chat->user;
        $chat->chat_content;
        foreach ($chat->chat_content as $chat_content) $chat_content->user;
        return $this->sendResponse($chat, asset('storage') . '/');
    }

    public function getFollowerById($id)
    {
        $followers = Follow::where('id_user', $id)->get();
        $followings = Follow::where('follower', $id)->get();
        foreach ($followers as $follower) {
            $follower->follower;
        }
        foreach ($followings as $following) {
            $following->user;
        }
        $followers_count = $followers->count();
        $following_count = $followings->count();
        return $this->sendResponse([
            // 'followers' => $followers,
            // 'following' => $followings,
            'followers_count' => $followers_count,
            'following_count' => $following_count
        ], asset('storage') . '/');
    }

    public function getUserByKeyword($keyword)
    {
        $users = User::where(DB::raw('lower(id)'), 'LIKE', "%{$keyword}%")
            ->orWhere(DB::raw('lower(name)'), 'LIKE', "%{$keyword}%")
            ->orWhere(DB::raw('lower(email)'), 'LIKE', "%{$keyword}%")
            ->orWhere(DB::raw('lower(bio)'), 'LIKE', "%{$keyword}%")
            ->orWhere(DB::raw('lower(mobile)'), 'LIKE', "%{$keyword}%")
            ->orWhere(DB::raw('lower(city)'), 'LIKE', "%{$keyword}%")
            ->get();
        return $this->sendResponse($users, asset('storage') . '/');
    }
}
