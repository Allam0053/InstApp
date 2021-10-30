<?php

namespace App\Http\Controllers\Save;

use App\Http\Controllers\Controller;
use App\Models\Saved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function store(Request $request)
    {
        $saved = Saved::where('id_user', Auth::id())->where('id_post', $request->id_post)->get()->first();
        if ($saved) {
            $saved->delete();
        } else {
            $saved = Saved::create([
                'id_user' => Auth::id(),
                'id_post' => $request->id_post
            ]);
        }

        return redirect()->back();
    }
}
