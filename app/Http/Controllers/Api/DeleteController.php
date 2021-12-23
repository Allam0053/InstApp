<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatContent;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deletePhotoFromApi($id)
    {
        $post = Post::findOrFail($id)->delete();
        return $this->sendResponse('image ' . $id . ' deleted', 'success deleted image');
    }

    public function posting($id)
    {
        $post = Post::where('id', $id)->first();
        if (Auth::user()->id == $post->id_user) {
            foreach ($post->comment as $comment) {
                $comment->delete();
            }
            foreach ($post->like as $like) {
                $like->delete();
            }
            $post->delete();
        } else return $this->sendResponse('you are not allowed to delete this post #' . $id, 'failed to delete post');
        return $this->sendResponse('post ' . $id . ' deleted', 'success deleted post');
    }

    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        if (Auth::user()->id == $comment->id_user) $comment->delete();
        else return $this->sendResponse('you are not allowed to delete this comment #' . $id, 'failed to delete comment');
        return $this->sendResponse('comment ' . $id . ' deleted', 'success deleted comment');
    }

    public function deleteGroupChat($id)
    {
        $chat = Chat::where('id', $id)->first();
        try {
            foreach ($chat->user_chat as $userchat) {
                $userchat->delete();
            }
            foreach ($chat->chat_content as $chat_content) {
                $chat_content->delete();
            }
            $chat->delete();
            return $this->sendResponse('chat group ' . $id . ' deleted', 'success deleted chat group');
        } catch (Exception $e) {
            return $this->sendResponse('chat group ' . $id . ' ~fail to delete', $e->getMessage());
        }
    }

    public function deleteChat($id)
    {
        $chatcontent = ChatContent::where('id', $id)->first();
        $chatcontent->delete();
        return $this->sendResponse('chat #' . $id . ' deleted', 'success deleted chat');
    }
}
