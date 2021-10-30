<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function store(Request $request)
    {
        $user = User::where('id', Auth::id())->get()->first();
        $user->update($request->all());

        return redirect()->back();
    }
}
