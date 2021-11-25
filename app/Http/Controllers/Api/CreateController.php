<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
        try {
            $user = User::where('email', 'camerapp@email.com')->get()->first();
            if (!$user) $user = $this->apiAccount();

            $post = Post::create([
                'caption' => $request->caption,
                'id_user' => $user->id
            ]);
            $post->update([
                'foto' => $this->saveFoto($request, $post->id)
            ]);
            return $this->sendResponse($post->foto, asset('storage') . '/' );
        } catch (Exception $e) {
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

    public function getExtension($data)
    {
        // $data = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAA.';
        $pos  = strpos($data, ';');
        $type = explode(':', substr($data, 0, $pos))[1];
        $extension = explode('/', $type)[1];
        return $extension;
    }

    public function saveFoto(Request $request, $id)
    {
        // init variables
        $foto = $request->foto; // datatype : file/base64
        $foto_name = ''; // datatype : string

        // what do i need to process if it's null?
        if ($foto == NULL) return '';

        // create a name for the image
        $foto_name = 'foto' . '-' . $id . "." . $this->getExtension($foto); // datatype : string
        $foto_name = str_replace(' ', '-', strtolower($foto_name)); // datatype : string

        // if the format is like 
        // "data:image/jpeg;base64, blahblahablah" 
        // then perform the action inside the 'if' statement
        if (preg_match('/^data:image\/(\w+);base64,/', $foto)) {
            $data = substr($foto, strpos($foto, ',') + 1);

            $data = base64_decode($data);
            Storage::disk('public')->put($foto_name, $data);
        } else {
			$data = base64_decode($foto);
			Storage::disk('public')->put($foto_name, $data);
		}

        // return filename.ext
        return $foto_name;
    }
}
