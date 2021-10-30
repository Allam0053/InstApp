<?php

namespace App\Http\Controllers\Like;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteLike($id)
    {
        $message = $this->deleteData('like', $id);
        return redirect()->back()->with('message', $message);
    }
}
