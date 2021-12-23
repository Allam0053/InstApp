<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $actionNotAllowed = 'you are not allowed to that action';

    /**
     * @return string
     */
    public function deleteData($table = null, $id = 0)
    {
        try {
            \DB::delete('delete from ' . $table . ' where id = ?', [$id]);
            return 'berhasil menghapus';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Mengirim response berhasil
    public function sendResponse($data, $message)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function getAssetLink()
    {
        return $this->sendResponse(asset('storage') . '/', null);
    }


    public function getExtension($data)
    {
        // $data = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAA.';
        $pos  = strpos($data, ';');
        $type = '';
        try {
            $type = explode(':', substr($data, 0, $pos))[1];
        } catch (Exception $e) {
            return '';
        }
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
        $ext = $this->getExtension($foto);
        if (!($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png'))
            return 'unknown file extension';
        $foto_name = 'foto' . '-' . $id . "." . $ext; // datatype : string
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


    public function saveAvatar(Request $request, $id)
    {
        $foto = $request->avatar; // typedata : file
        $foto_name = ''; // typedata : string
        if ($foto !== NULL) {
            $foto_name = 'avatar' . '-' . $id . "." . $foto->extension(); // typedata : string
            $foto_name = str_replace(' ', '-', strtolower($foto_name)); // typedata : string
            $foto->storeAs(null, $foto_name, ['disk' => 'public']); // memanggil function untuk menaruh file di storage
            // $foto->Storage::disk('public')->put('storage/' . $foto_name, $foto);
        }
        return $foto_name; // me return path/to/file.ext
    }

    public function saveAvatarApi(Request $request, $id)
    {
        // init variables
        $foto = $request->avatar; // datatype : file/base64
        $foto_name = ''; // datatype : string

        // what do i need to process if it's null?
        if ($foto == NULL) return '';

        // create a name for the image
        $ext = $this->getExtension($foto);
        if (!($ext == 'bmp' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'dib' || $ext == 'jpe' || $ext == 'tif' || $ext == 'tiff'))
            return 'unknown file extension';
        $foto_name = 'avatar' . '-' . $id . "." . $ext; // datatype : string
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
