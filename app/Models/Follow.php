<?php
// PHPファイルの開始

namespace App\Models;
// このファイルが App\Models の中にあることを示す
// Modelファイル用の名前空間

use Illuminate\Database\Eloquent\Model;
// LaravelのEloquentモデル機能を使うための読み込み
// DBテーブルをPHPのクラスとして扱えるようにする

class Follow extends Model
// Followクラスを定義する
// Modelを継承しているので、followsテーブルを操作できるモデルになる
{
    protected $fillable = [
        // create() や update() で一括保存していいカラムを指定する

        'follower_id',
        // フォローする側のユーザーid
        // 例：ログイン中のユーザーid

        'followed_id',
        // フォローされる側のユーザーid
        // 例：フォローしたい相手のユーザーid
    ];
}