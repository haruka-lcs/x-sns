<?php

// このファイルが所属する名前空間を指定する
namespace App\Http\Controllers;

// 投稿データを扱うPostモデルを読み込む
use App\Models\Post;

// ユーザーデータを扱うUserモデルを読み込む
use App\Models\User;

// フォームから送られてきたリクエスト情報を扱うRequestを読み込む
use Illuminate\Http\Request;

// 投稿機能を管理するコントローラーを定義する
class PostController extends Controller
{
    // 投稿画面を表示するメソッド
    public function create()
    {
        // セッションからログイン中ユーザーのIDを取得する
        $loginUserId = session('login_user_id');

        // ログイン中ユーザーIDがある場合はユーザー情報を取得し、ない場合はnullにする
        $loginUser = $loginUserId ? User::find($loginUserId) : null;

        // post.blade.phpを表示し、ログイン中ユーザー情報を渡す
        return view('post', [

            // ログイン中ユーザー情報をビューに渡す
            'loginUser' => $loginUser,
        ]);
    }

    // 投稿内容をDBに保存するメソッド
    public function store(Request $request)
    {
        // 投稿本文の入力内容をバリデーションする
        $request->validate([

            // bodyは必須・文字列・255文字以内にする
            'body' => ['required', 'string', 'max:255'],
        ], [

            // bodyが空だった時のエラーメッセージ
            'body.required' => '投稿内容を入力してください。',

            // bodyが255文字を超えた時のエラーメッセージ
            'body.max' => '投稿は255文字以内で入力してください。',
        ]);

        // postsテーブルに新しい投稿を保存する
        Post::create([

            // 投稿者IDとしてログイン中ユーザーIDを保存する
            'user_id' => session('login_user_id'),

            // 投稿本文として入力されたbodyを保存する
            'body' => $request->body,
        ]);

        // 投稿保存後、ホーム画面へ移動する
        return redirect('/home');
    }

    // 投稿を削除するメソッド
    public function destroy(Post $post)
    {
        // 投稿者IDとログイン中ユーザーIDが一致しない場合の処理
        if ($post->user_id !== session('login_user_id')) {

            // 自分の投稿ではないので、削除せずホーム画面へ移動する
            return redirect('/home');
        }

        // 自分の投稿だった場合、投稿を削除する
        $post->delete();

        // 削除後、ホーム画面へ移動する
        return redirect('/home');
    }
}