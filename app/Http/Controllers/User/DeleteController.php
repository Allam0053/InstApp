<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function deleteUser()
    {
        Auth::guard('web')->logout();
        $message = $this->deleteData('users', Auth::id());

        return redirect('/');
    }
}
