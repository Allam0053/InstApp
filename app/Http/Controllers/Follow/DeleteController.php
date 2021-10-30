<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteFollow($id)
    {
        $message = $this->deleteData('follow', $id);
        return redirect()->back()->with('message', $message);
    }
}
