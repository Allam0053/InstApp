<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
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
                'caption' => $r->caption
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
}
