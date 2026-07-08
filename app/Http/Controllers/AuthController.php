<?php

// このファイルが所属する名前空間を指定する
namespace App\Http\Controllers;

// ユーザーデータを扱うUserモデルを読み込む
use App\Models\User;

// フォームから送られてきたリクエスト情報を扱うRequestを読み込む
use Illuminate\Http\Request;

// パスワードをハッシュ化・確認するためにHashを読み込む
use Illuminate\Support\Facades\Hash;

// ログイン・新規登録処理を管理するコントローラーを定義する
class AuthController extends Controller
{
    // 新規登録処理を行うメソッド
    public function register(Request $request)
    {
        // 新規登録フォームの入力内容をバリデーションする
        $request->validate([

            // ユーザーネームは必須・50文字以内にする
            'user_name' => 'required|max:50',

            // ユーザーIDは必須・50文字以内・usersテーブルのaccount_idと重複不可にする
            'account_id' => 'required|max:50|unique:users,account_id',

            // パスワードは必須・50文字以内にする
            'password' => 'required|max:50',
        ]);

        // usersテーブルに新しいユーザーを作成する
        $user = User::create([

            // 入力されたユーザーネームを保存する
            'user_name' => $request->user_name,

            // 入力されたユーザーIDを保存する
            'account_id' => $request->account_id,

            // 入力されたパスワードをハッシュ化して保存する
            'password' => Hash::make($request->password),

            // プロフィール画像は初期状態では登録しない
            'profile_image' => null,
        ]);

        // 登録したユーザーIDをセッションに保存してログイン状態にする
        session([

            // login_user_idという名前で、登録したユーザーのIDを保存する
            'login_user_id' => $user->id,
        ]);

        // 新規登録後、ホーム画面へ移動する
        return redirect('/home');
    }

    // ログイン処理を行うメソッド
    public function login(Request $request)
    {
        // ログインフォームの入力内容をバリデーションする
        $request->validate([

            // ユーザーIDは必須にする
            'account_id' => 'required',

            // パスワードは必須にする
            'password' => 'required',
        ]);

        // 入力されたユーザーIDと一致するユーザーをusersテーブルから1件取得する
        $user = User::where('account_id', $request->account_id)->first();

        // パスワードが一致しているかどうかを入れる変数を用意する
        $passwordMatches = false;

        // ハッシュ化されたパスワードとの照合でエラーが出ても止まらないようにする
        try {

            // 入力されたパスワードとDBに保存されているハッシュ化パスワードを比較する
            $passwordMatches = Hash::check($request->password, $user?->password ?? '');

        // Hash::checkでエラーが起きた場合の処理
        } catch (\RuntimeException $e) {

            // パスワード不一致として扱う
            $passwordMatches = false;
        }

        // ユーザーが存在しない場合の処理
        if ($user === null) {

            // 前の画面に戻る
            return back()

                // 入力したユーザーIDをフォームに残す
                ->withInput()

                // エラーメッセージを渡す
                ->withErrors([

                    // loginという名前でエラーメッセージを登録する
                    'login' => 'ユーザーIDまたはパスワードが違います',
                ]);
        }

        // ハッシュ化パスワードとは一致しないが、DB内の平文パスワードとは一致する場合の処理
        if (!$passwordMatches && $user->password === $request->password) {

            // パスワード一致として扱う
            $passwordMatches = true;

            // 平文で保存されていたパスワードをハッシュ化したものに変更する
            $user->password = Hash::make($request->password);

            // ハッシュ化したパスワードをDBに保存する
            $user->save();
        }

        // パスワードが一致しなかった場合の処理
        if (!$passwordMatches) {

            // 前の画面に戻る
            return back()

                // 入力したユーザーIDをフォームに残す
                ->withInput()

                // エラーメッセージを渡す
                ->withErrors([

                    // loginという名前でエラーメッセージを登録する
                    'login' => 'ユーザーIDまたはパスワードが違います',
                ]);
        }

        // ログイン成功時、ユーザーIDをセッションに保存する
        session([

            // login_user_idという名前でログイン中ユーザーのIDを保存する
            'login_user_id' => $user->id,
        ]);

        // ログイン後、ホーム画面へ移動する
        return redirect('/home');
    }
}