<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make($request->password),
            'profile_image' => null,
        ]);

       session([
            'login_user_id' => $user->id,
        ]);

        return redirect('/home');
    }

    public function login(Request $request)
    {
        $request->validate([
            'account_id' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('account_id', $request->account_id)->first();

        $passwordMatches = false;

        try {
            $passwordMatches = Hash::check($request->password, $user?->password ?? '');
        } catch (\RuntimeException $e) {
            $passwordMatches = false;
        }

        if ($user === null) {
            return back()
                ->withInput()
                ->withErrors([
                    'login' => 'ユーザーIDまたはパスワードが違います',
                ]);
        }

        if (!$passwordMatches && $user->password === $request->password) {
            $passwordMatches = true;
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if (!$passwordMatches) {
            return back()
                ->withInput()
                ->withErrors([
                    'login' => 'ユーザーIDまたはパスワードが違います',
                ]);
        }

        session([
            'login_user_id' => $user->id,
        ]);

        return redirect('/home');
    }
}