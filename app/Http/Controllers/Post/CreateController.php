<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create()
    {
        return view('create-post');
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'caption' => $request->caption,
            'id_user' => Auth::guard('web')->user()->id
        ]);
        $post->update([
            'foto' => $this->saveFoto($request, $post->id)
        ]);

        return redirect()->route('post.view', ['id' => $post->id]);
    }

    public function saveFoto(Request $request, $id)
    {
        $foto = $request->foto; // typedata : file
        $foto_name = ''; // typedata : string
        if ($foto !== NULL) {
            $foto_name = 'foto' . '-' . $id . "." . $foto->extension(); // typedata : string
            $foto_name = str_replace(' ', '-', strtolower($foto_name)); // typedata : string
            $foto->storeAs(null, $foto_name, ['disk' => 'public']); // memanggil function untuk menaruh file di storage
        }
        return asset('storage') . '/' . $foto_name; // me return path/to/file.ext
    }
}
