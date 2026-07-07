<?php

namespace App\Http\Controllers;
// このファイルが App\Http\Controllers の中にあることを示す

use App\Models\Post;
// postsテーブルを操作するPostモデルを使う

use Illuminate\Http\Request;
// フォームから送られてきた値を受け取るRequestを使う

class PostController extends Controller
// PostControllerクラスを定義する
// Controllerを継承しているのでLaravelのコントローラーとして使える
{
    public function create()
    // 投稿作成画面を表示するメソッド
    {
        return view('posts.create');
        // resources/views/posts/create.blade.php を表示する
    }

    public function store(Request $request)
    // 投稿を保存するメソッド
    // $requestには投稿フォームから送られてきた値が入る
    {
        $request->validate([
            // 投稿フォームの入力チェックをする

            'body' => ['required', 'string', 'max:255'],
            // bodyは必須
            // 文字列である必要がある
            // 最大255文字まで
        ], [
            // バリデーションエラー時のメッセージを設定する

            'body.required' => '投稿内容を入力してください。',
            // bodyが空だったときに表示するエラーメッセージ

            'body.max' => '投稿は255文字以内で入力してください。',
            // bodyが255文字を超えたときに表示するエラーメッセージ
        ]);

        Post::create([
            // postsテーブルに新しい投稿を作成する

            'user_id' => session('login_user_id'),
            // 投稿したユーザーidとして、セッションに保存されているログイン中ユーザーidを保存する

            'body' => $request->body,
            // フォームに入力された投稿本文を保存する
        ]);

        return redirect('/home');
        // 投稿保存後、ホーム画面へ移動する
    }

    public function destroy(Post $post)
    // 投稿を削除するメソッド
    // URLの/posts/{post}に入った投稿idから、Laravelが自動でPostデータを取得して$postに入れる
    {
        if ($post->user_id !== session('login_user_id')) {
            // 削除しようとしている投稿のuser_idと、ログイン中ユーザーidが違うか確認する
            // つまり、自分の投稿ではない投稿を削除しようとしていないか確認する

            return redirect('/home');
            // 自分の投稿ではない場合は削除せず、ホーム画面へ戻す
        }

        $post->delete();
        // postsテーブルから該当する投稿を削除する

        return redirect('/home');
        // 削除後、ホーム画面へ移動する
    }
}