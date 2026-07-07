<?php

namespace App\Models;
// このファイルが App\Models の中にあることを示す
// Modelファイル用の名前空間

use Illuminate\Database\Eloquent\Model;
// LaravelのEloquentモデル機能を使うための読み込み
// DBテーブルをPHPのクラスとして扱えるようにする

class Post extends Model
// Postクラスを定義する
// Modelを継承しているので、postsテーブルを操作できるモデルになる
{
    protected $fillable = [
        // create() や update() で一括保存していいカラムを指定する

        'user_id',
        // 投稿したユーザーのid
        // usersテーブルのidとつながる

        'body',
        // 投稿本文
    ];

    public function user()
    // userというメソッドを定義する
    // この投稿を書いたユーザー情報を取得するための関係を書く
    {
        return $this->belongsTo(User::class);
        // この投稿は1人のユーザーに所属している、という意味
        // postsテーブルのuser_idと、usersテーブルのidをつなげる
    }
}