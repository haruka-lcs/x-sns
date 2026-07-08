<?php

// このファイルが所属する名前空間を指定する
namespace App\Http\Controllers;

// フォロー情報を扱うFollowモデルを読み込む
use App\Models\Follow;

// フォームやリクエスト情報を扱うRequestを読み込む
use Illuminate\Http\Request;

// フォロー機能を管理するコントローラーを定義する
class FollowController extends Controller
{
    // フォロー処理を行うメソッド
    public function store($userId)
    {
        // セッションからログイン中ユーザーのIDを取得する
        $loginUserId = session('login_user_id');

        // ログイン中ユーザーIDがない場合の処理
        if ($loginUserId === null) {

            // ログインしていないのでログイン画面へ移動する
            return redirect('/login');
        }

        // ログイン中ユーザーIDとフォロー対象ユーザーIDが同じか確認する
        if ((int) $loginUserId === (int) $userId) {

            // 自分自身はフォローできないのでホーム画面へ戻る
            return redirect('/home');
        }

        // followsテーブルにフォロー情報を保存する
        Follow::firstOrCreate([

            // フォローする側のユーザーIDを保存する
            'follower_id' => $loginUserId,

            // フォローされる側のユーザーIDを保存する
            'followed_id' => $userId,
        ]);

        // フォロー後、ホーム画面へ移動する
        return redirect('/home');
    }

    // フォロー解除処理を行うメソッド
    public function destroy($userId)
    {
        // セッションからログイン中ユーザーのIDを取得する
        $loginUserId = session('login_user_id');

        // ログイン中ユーザーIDがない場合の処理
        if ($loginUserId === null) {

            // ログインしていないのでログイン画面へ移動する
            return redirect('/login');
        }

        // followsテーブルからログイン中ユーザーのフォロー情報を探す
        Follow::where('follower_id', $loginUserId)

            // フォロー解除したい相手のユーザーIDで絞り込む
            ->where('followed_id', $userId)

            // 条件に一致したフォロー情報を削除する
            ->delete();

        // フォロー解除後、ホーム画面へ移動する
        return redirect('/home');
    }
}