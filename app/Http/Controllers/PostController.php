<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
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
}