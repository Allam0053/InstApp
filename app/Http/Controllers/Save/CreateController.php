<?php

namespace App\Http\Controllers\Save;

use App\Http\Controllers\Controller;
use App\Models\Saved;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function store(Request $request)
    {
        $saved = Saved::where('id_user', $request->id_user)->where('id_post', $request->id_post)->get()->first();
        if ($saved) {
            $saved->delete();
        } else {
            $saved = Saved::create([
                'id_user' => $request->id_user,
                'id_post' => $request->id_post
            ]);
        }

        return redirect()->back();
    }
}
