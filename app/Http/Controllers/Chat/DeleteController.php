<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteChat($id)
    {
        $message = $this->deleteData('chat', $id);
        return redirect()->back()->with('message', $message);
    }
}
