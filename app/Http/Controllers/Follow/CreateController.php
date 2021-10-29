<?php

namespace App\Http\Controllers\Follow;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function store(Request $request)
    {
        $follow = Follow::create([
            'id_user' => $request->id_user,
            'follower' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
