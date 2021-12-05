<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
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
                'id_user' => Auth::guard('api')->user()->id
            ]);
            $post_id = $post->id;
            $post->update([
                'foto' => $this->saveFoto($r, $post->id)
            ]);
            if ($post->foto == 'unknown file extension')
                throw new Exception('unknown file extension');
            return $this->sendResponse($post->foto, asset('storage') . '/');
        } catch (Exception $e) {
            Post::where('id', $post_id)->first()->delete($post_id);
            return $this->sendResponse('failed adding', $e->message);
        }
    }

    public function liking($id)
    {
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
    }
}
