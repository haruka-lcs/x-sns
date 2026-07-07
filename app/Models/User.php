<?php

namespace App\Models;
// このファイルが App\Models の中にあることを示す
// Modelファイル用の名前空間

use Illuminate\Database\Eloquent\Model;
// LaravelのEloquentモデル機能を使うための読み込み
// DBテーブルをPHPのクラスとして扱えるようにする

class User extends Model
// Userクラスを定義する
// Modelを継承しているので、usersテーブルを操作できるモデルになる
{
    protected $fillable = [
        // create() や update() で一括保存していいカラムを指定する

        'user_name',
        // ユーザーの表示名
        // 例：田中、佐藤、ハル など

        'account_id',
        // @から始まるユーザーIDに使う値
        // 例：haru、tanaka など

        'password',
        // ログイン用のパスワード
        // 今はハッシュ化せず、そのまま保存している

        'profile_image',
        // プロフィール画像の保存パス
        // 画像がない場合はnullになる
    ];

    public function posts()
    // postsというメソッドを定義する
    // このユーザーが投稿した投稿一覧を取得するための関係を書く
    {
        return $this->hasMany(Post::class);
        // このユーザーは複数の投稿を持っている、という意味
        // usersテーブルのidと、postsテーブルのuser_idをつなげる
    }
}