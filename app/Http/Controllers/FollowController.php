<?php
// PHPファイルの開始

namespace App\Http\Controllers;
// このファイルが App\Http\Controllers の中にあることを示す

use App\Models\Follow;
// followsテーブルを操作するFollowモデルを使う

use Illuminate\Http\Request;
// フォームから送られてきた値を受け取るRequestを使う
// ただし、このコード内ではRequestは使っていない

class FollowController extends Controller
// FollowControllerクラスを定義する
// Controllerを継承しているのでLaravelのコントローラーとして使える
{
    public function store($userId)
    // フォロー処理をするメソッド
    // $userIdにはフォローしたい相手のユーザーidが入る
    {
        $loginUserId = session('login_user_id');
        // セッションからログイン中のユーザーidを取得する

        if ($loginUserId === null) {
            // ログイン中のユーザーidがなければ
            // つまりログインしていなければ

            return redirect('/login');
            // ログイン画面へ移動する
        }

        if ((int) $loginUserId === (int) $userId) {
            // ログイン中のユーザーidとフォローしたい相手のidが同じか確認する
            // (int)で数値に変換してから比較している
            // つまり、自分自身をフォローしようとしていないか確認している

            return redirect('/home');
            // 自分自身はフォローできないので、ホーム画面へ戻す
        }

        Follow::firstOrCreate([
            // followsテーブルにフォロー関係を作成する
            // すでに同じデータがある場合は新しく作らない

            'follower_id' => $loginUserId,
            // フォローする側のユーザーid
            // ここではログイン中のユーザーid

            'followed_id' => $userId,
            // フォローされる側のユーザーid
            // ここではフォローしたい相手のユーザーid
        ]);

        return redirect('/home');
        // フォロー処理が終わったらホーム画面へ移動する
    }

    public function destroy($userId)
    // フォロー解除処理をするメソッド
    // $userIdにはフォロー解除したい相手のユーザーidが入る
    {
        $loginUserId = session('login_user_id');
        // セッションからログイン中のユーザーidを取得する

        if ($loginUserId === null) {
            // ログイン中のユーザーidがなければ
            // つまりログインしていなければ

            return redirect('/login');
            // ログイン画面へ移動する
        }

        Follow::where('follower_id', $loginUserId)
            // followsテーブルからfollower_idがログイン中ユーザーidのデータを探す
            // つまり、自分がフォローしているデータを探す

            ->where('followed_id', $userId)
            // さらにfollowed_idがフォロー解除したい相手のidのデータに絞る

            ->delete();
            // 条件に合うフォロー関係を削除する
            // これでフォロー解除になる

        return redirect('/home');
        // フォロー解除が終わったらホーム画面へ移動する
    }
}