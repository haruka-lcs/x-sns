<?php
// PHPファイルの開始

namespace App\Http\Controllers;
// このファイルが App\Http\Controllers という場所にあることを示す
// Controllerファイル用の名前空間

use App\Models\User;
// usersテーブルを操作するUserモデルを使う

use Illuminate\Http\Request;
// フォームから送られてきた値を受け取るRequestを使う

class AuthController extends Controller
// AuthControllerクラスを定義する
// Controllerを継承しているので、Laravelのコントローラーとして使える
{
    public function register(Request $request)
    // 新規登録処理をするメソッド
    // $requestには新規登録フォームから送られてきた値が入る
    {
        $request->validate([
            // フォームの入力チェックをする

            'user_name' => 'required|max:50',
            // user_nameは必須
            // 最大50文字まで

            'account_id' => 'required|max:50|unique:users,account_id',
            // account_idは必須
            // 最大50文字まで
            // usersテーブルのaccount_idと重複してはいけない

            'password' => 'required|max:50',
            // passwordは必須
            // 最大50文字まで
        ]);

        $user = User::create([
            // usersテーブルに新しいユーザーを作成する

            'user_name' => $request->user_name,
            // フォームに入力されたuser_nameを保存する

            'account_id' => $request->account_id,
            // フォームに入力されたaccount_idを保存する

            'password' => $request->password,
            // フォームに入力されたpasswordを保存する
            // 今はハッシュ化せず、そのまま保存している

            'profile_image' => null,
            // プロフィール画像はまだ登録しないのでnullを保存する
        ]);

        session([
            // セッションにデータを保存する

            'login_user_id' => $user->id,
            // 今作成したユーザーのidをlogin_user_idとして保存する
            // これで新規登録後にログイン中として扱える
        ]);

        return redirect('/home');
        // 新規登録が終わったらホーム画面へ移動する
    }

    public function login(Request $request)
    // ログイン処理をするメソッド
    // $requestにはログインフォームから送られてきた値が入る
    {
        $request->validate([
            // ログインフォームの入力チェックをする

            'account_id' => 'required',
            // account_idは必須

            'password' => 'required',
            // passwordは必須
        ]);

        $user = User::where('account_id', $request->account_id)
            // usersテーブルからaccount_idが入力値と一致するユーザーを探す

            ->where('password', $request->password)
            // さらにpasswordが入力値と一致するユーザーに絞る

            ->first();
            // 条件に合うユーザーを1件だけ取得する
            // 見つからなければnullになる

        if ($user === null) {
            // ユーザーが見つからなかった場合
            // つまり、ユーザーIDかパスワードが間違っている場合

            return back()
                // 直前の画面、つまりログイン画面に戻る

                ->withInput()
                // 入力していた値をもう一度フォームに残す

                ->withErrors([
                    // エラーメッセージを画面に渡す

                    'login' => 'ユーザーIDまたはパスワードが違います',
                    // loginという名前でエラーメッセージを保存する
                ]);
        }

        session([
            // セッションにデータを保存する

            'login_user_id' => $user->id,
            // ログイン成功したユーザーのidをlogin_user_idとして保存する
            // これでログイン中のユーザーとして扱える
        ]);

        return redirect('/home');
        // ログイン成功後、ホーム画面へ移動する
    }
}