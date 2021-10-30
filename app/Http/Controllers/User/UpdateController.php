<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function update(Request $request)
    {
        $user = User::where('id', Auth::id())->get()->first();
        $user->update($request->all());

        // $user = Auth::user();
        // dd($request->bio);
        // $user->update([
        //     'bio' => $request->bio,
        //     'mobile' => $request->mobile,
        //     'city' => $request->city
        // ]);

        return redirect()->back();
    }
}
