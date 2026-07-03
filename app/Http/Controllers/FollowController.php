<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store($userId)
    {
        $loginUserId = session('login_user_id');

        if ($loginUserId === null) {
            return redirect('/login');
        }

        if ((int) $loginUserId === (int) $userId) {
            return redirect('/home');
        }

        Follow::firstOrCreate([
            'follower_id' => $loginUserId,
            'followed_id' => $userId,
        ]);

        return redirect('/home');
    }

    public function destroy($userId)
    {
        $loginUserId = session('login_user_id');

        if ($loginUserId === null) {
            return redirect('/login');
        }

        Follow::where('follower_id', $loginUserId)
            ->where('followed_id', $userId)
            ->delete();

        return redirect('/home');
    }
}