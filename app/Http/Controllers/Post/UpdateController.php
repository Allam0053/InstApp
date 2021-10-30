<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit-post', compact('post'));
    }

    public function update(Request $request)
    {
        $post = Post::findOrFail($request->id_post);
        if ($request->foto) {

            Storage::delete($post->foto);

            $post->update([
                'foto' => $this->saveFoto($request, $post->id)
            ]);
        }
        if ($request->caption) {
            $post->update([
                'caption' => $request->caption
            ]);
        }
        return redirect()->back();
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
