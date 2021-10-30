<?php

namespace App\Http\Controllers\Story;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteStory($id)
    {
        $message = $this->deleteData('story', $id);
        return redirect()->back()->with('message', $message);
    }
}
