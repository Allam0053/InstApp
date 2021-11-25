<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }
}
