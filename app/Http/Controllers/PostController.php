<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $loginUserId = session('login_user_id');
        $loginUser = $loginUserId ? User::find($loginUserId) : null;

        return view('post', [
            'loginUser' => $loginUser,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:255'],
        ], [
            'body.required' => '投稿内容を入力してください。',
            'body.max' => '投稿は255文字以内で入力してください。',
        ]);

        Post::create([
            'user_id' => session('login_user_id'),
            'body' => $request->body,
        ]);

        return redirect('/home');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== session('login_user_id')) {
            return redirect('/home');
        }

        $post->delete();

        return redirect('/home');
    }
}