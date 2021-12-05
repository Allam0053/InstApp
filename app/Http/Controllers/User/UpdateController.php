<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function update(Request $request)
    {
        $user = User::where('id', Auth::id())->get()->first();
        // dd($request->avatar);
        $user->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'avatar' => $this->saveAvatar($request, $user->id)
        ]);

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
