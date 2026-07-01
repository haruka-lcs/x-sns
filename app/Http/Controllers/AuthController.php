<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:50',
            'account_id' => 'required|max:50|unique:users,account_id',
            'password' => 'required|max:50',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'account_id' => $request->account_id,
            'password' => $request->password,
            'profile_image' => null,
        ]);

        session([
            'login_user_id' => $user->id,
        ]);

        return redirect('/home');
    }
}