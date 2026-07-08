<?php

// HTTPリクエストの情報を扱うためにRequestを読み込む
use Illuminate\Http\Request;

// パスワードをハッシュ化するためにHashを読み込む
use Illuminate\Support\Facades\Hash;

// ルーティングを設定するためにRouteを読み込む
use Illuminate\Support\Facades\Route;

// 画像ファイルの保存・削除をするためにStorageを読み込む
use Illuminate\Support\Facades\Storage;

// 投稿データを扱うPostモデルを読み込む
use App\Models\Post;

// ユーザーデータを扱うUserモデルを読み込む
use App\Models\User;

// フォローデータを扱うFollowモデルを読み込む
use App\Models\Follow;

// ログイン・新規登録処理をまとめたAuthControllerを読み込む
use App\Http\Controllers\AuthController;

// 投稿作成・投稿削除処理をまとめたPostControllerを読み込む
use App\Http\Controllers\PostController;

// フォロー・フォロー解除処理をまとめたFollowControllerを読み込む
use App\Http\Controllers\FollowController;

// トップ画面を表示するルート
Route::get('/', function () {

    // top.blade.phpを表示する
    return view('top');

// トップ画面のルート処理を終了する
});

// ログイン画面を表示するルート
Route::get('/login', function () {

    // login.blade.phpを表示する
    return view('login');

// ログイン画面のルート処理を終了する
});

// ログイン処理を実行するルート
Route::post('/login', [AuthController::class, 'login'])

    // このルートにlogin.checkという名前を付ける
    ->name('login.check');

// 新規登録画面を表示するルート
Route::get('/register', function () {

    // register.blade.phpを表示する
    return view('register');

// 新規登録画面のルート処理を終了する
});

// 新規登録処理を実行するルート
Route::post('/register', [AuthController::class, 'register']);

// ホーム画面の全体タブを表示するルート
Route::get('/home', function () {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // ログイン中ユーザーIDからユーザー情報を取得する
    $loginUser = User::find($loginUserId);

    // ログイン中ユーザーがDBに存在しない場合の処理
    if ($loginUser === null) {

        // セッションに残っているログイン中ユーザーIDを削除する
        session()->forget('login_user_id');

        // ログイン画面へ移動する
        return redirect('/login');

    // ユーザー存在確認の条件分岐を終了する
    }

    // 投稿データをユーザー情報と一緒に取得する
    $posts = Post::with('user')

        // 新しい投稿順に並べる
        ->latest()

        // 投稿一覧を取得する
        ->get();

    // ログイン中ユーザーがフォローしているユーザーID一覧を取得する
    $followingIds = Follow::where('follower_id', $loginUserId)

        // followed_idだけを取り出す
        ->pluck('followed_id')

        // 配列に変換する
        ->toArray();

    // home.blade.phpを表示し、必要なデータを渡す
    return view('home', [

        // ログイン中ユーザー情報をビューに渡す
        'loginUser' => $loginUser,

        // 投稿一覧をビューに渡す
        'posts' => $posts,

        // フォロー中ユーザーID一覧をビューに渡す
        'followingIds' => $followingIds,

        // 現在のタブが全体であることをビューに渡す
        'activeTab' => 'all',

        // 投稿がない時に表示するメッセージをビューに渡す
        'emptyMessage' => 'まだ投稿がありません。',
    ]);

// ホーム画面の全体タブルート処理を終了する
})

// このルートにhomeという名前を付ける
->name('home');

// ホーム画面のフォロー中タブを表示するルート
Route::get('/home/following', function () {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // ログイン中ユーザーIDからユーザー情報を取得する
    $loginUser = User::find($loginUserId);

    // ログイン中ユーザーがDBに存在しない場合の処理
    if ($loginUser === null) {

        // セッションに残っているログイン中ユーザーIDを削除する
        session()->forget('login_user_id');

        // ログイン画面へ移動する
        return redirect('/login');

    // ユーザー存在確認の条件分岐を終了する
    }

    // ログイン中ユーザーがフォローしているユーザーID一覧を取得する
    $followingIds = Follow::where('follower_id', $loginUserId)

        // followed_idだけを取り出す
        ->pluck('followed_id')

        // 配列に変換する
        ->toArray();

    // フォロー中ユーザーの投稿だけを取得する
    $posts = Post::with('user')

        // 投稿者IDがフォロー中ユーザーID一覧に含まれている投稿だけに絞る
        ->whereIn('user_id', $followingIds)

        // 新しい投稿順に並べる
        ->latest()

        // 投稿一覧を取得する
        ->get();

    // home.blade.phpを表示し、必要なデータを渡す
    return view('home', [

        // ログイン中ユーザー情報をビューに渡す
        'loginUser' => $loginUser,

        // フォロー中ユーザーの投稿一覧をビューに渡す
        'posts' => $posts,

        // フォロー中ユーザーID一覧をビューに渡す
        'followingIds' => $followingIds,

        // 現在のタブがフォロー中であることをビューに渡す
        'activeTab' => 'following',

        // フォロー中投稿がない時に表示するメッセージをビューに渡す
        'emptyMessage' => 'フォロー中の投稿はまだありません。',
    ]);

// ホーム画面のフォロー中タブルート処理を終了する
})

// このルートにhome.followingという名前を付ける
->name('home.following');

// 投稿画面を表示するルート
Route::get('/post', [PostController::class, 'create'])

    // このルートにposts.createという名前を付ける
    ->name('posts.create');

// 投稿作成処理を実行するルート
Route::post('/posts', [PostController::class, 'store'])

    // このルートにposts.storeという名前を付ける
    ->name('posts.store');

// 投稿作成処理を実行するルート
Route::post('/posts', function (Request $request) {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // 投稿本文のバリデーションを行う
    $request->validate([

        // bodyは必須・文字列・140文字以内にする
        'body' => ['required', 'string', 'max:140'],
    ], [

        // bodyが空だった時のエラーメッセージ
        'body.required' => '投稿内容を入力してください。',

        // bodyが140文字を超えた時のエラーメッセージ
        'body.max' => '投稿は140文字以内で入力してください。',
    ]);

    // postsテーブルに新しい投稿を保存する
    Post::create([

        // 投稿者IDとしてログイン中ユーザーIDを保存する
        'user_id' => $loginUserId,

        // 投稿本文として入力されたbodyを保存する
        'body' => $request->body,
    ]);

    // 投稿保存後、ホーム画面へ移動する
    return redirect('/home');

// 投稿作成処理を終了する
});

// 投稿削除処理を実行するルート
Route::delete('/posts/{post}', [PostController::class, 'destroy'])

    // このルートにposts.destroyという名前を付ける
    ->name('posts.destroy');

// プロフィール画面を表示するルート
Route::get('/profile', function () {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // ログイン中ユーザーIDからユーザー情報を取得する
    $loginUser = User::find($loginUserId);

    // ログイン中ユーザーがDBに存在しない場合の処理
    if ($loginUser === null) {

        // セッションに残っているログイン中ユーザーIDを削除する
        session()->forget('login_user_id');

        // ログイン画面へ移動する
        return redirect('/login');

    // ユーザー存在確認の条件分岐を終了する
    }

    // ログイン中ユーザーの投稿だけを取得する
    $posts = Post::with('user')

        // user_idがログイン中ユーザーIDと一致する投稿だけに絞る
        ->where('user_id', $loginUserId)

        // 新しい投稿順に並べる
        ->latest()

        // 投稿一覧を取得する
        ->get();

    // profile.blade.phpを表示し、必要なデータを渡す
    return view('profile', [

        // ログイン中ユーザー情報をビューに渡す
        'loginUser' => $loginUser,

        // 自分の投稿一覧をビューに渡す
        'posts' => $posts,
    ]);

// プロフィール画面のルート処理を終了する
});

// プロフィール編集処理を実行するルート
Route::post('/profile/edit', function (Request $request) {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // ログイン中ユーザーIDからユーザー情報を取得する
    $loginUser = User::find($loginUserId);

    // ログイン中ユーザーがDBに存在しない場合の処理
    if ($loginUser === null) {

        // セッションに残っているログイン中ユーザーIDを削除する
        session()->forget('login_user_id');

        // ログイン画面へ移動する
        return redirect('/login');

    // ユーザー存在確認の条件分岐を終了する
    }

    // プロフィール編集フォームの入力内容をバリデーションする
    $request->validate([

        // ユーザーIDは必須・50文字以内・自分以外と重複不可にする
        'account_id' => 'required|max:50|unique:users,account_id,' . $loginUser->id,

        // ユーザーネームは必須・50文字以内にする
        'user_name' => 'required|max:50',

        // パスワードは空でもOK・文字列・50文字以内にする
        'password' => ['nullable', 'string', 'max:50'],

        // プロフィール画像は空でもOK・画像ファイル・2MB以内にする
        'profile_image' => ['nullable', 'image', 'max:2048'],
    ]);

    // 現在登録されているプロフィール画像のパスを一旦入れておく
    $profileImagePath = $loginUser->profile_image;

    // 新しいプロフィール画像がアップロードされていて、有効なファイルか確認する
    if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {

        // すでにプロフィール画像が登録されている場合の処理
        if ($loginUser->profile_image) {

            // 古いプロフィール画像をpublicディスクから削除する
            Storage::disk('public')->delete($loginUser->profile_image);

        // 古い画像がある場合の条件分岐を終了する
        }

        // 新しいプロフィール画像をstorage/app/public/profile_imagesに保存する
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');

    // プロフィール画像アップロード処理を終了する
    }

    // 更新するユーザー情報を配列にまとめる
    $updateData = [

        // 入力されたユーザーIDを更新データに入れる
        'account_id' => $request->account_id,

        // 入力されたユーザーネームを更新データに入れる
        'user_name' => $request->user_name,

        // プロフィール画像のパスを更新データに入れる
        'profile_image' => $profileImagePath,
    ];

    // パスワードが入力されている場合だけ更新する
    if ($request->filled('password')) {

        // 入力されたパスワードをハッシュ化して更新データに入れる
        $updateData['password'] = Hash::make($request->password);

    // パスワード更新の条件分岐を終了する
    }

    // ログイン中ユーザーの情報を更新する
    $loginUser->update($updateData);

    // 更新後、プロフィール画面へ移動する
    return redirect('/profile');

// プロフィール編集処理を終了する
})

// このルートにprofile.updateという名前を付ける
->name('profile.update');

// プロフィール編集画面を表示するルート
Route::get('/profile/edit', function () {

    // セッションからログイン中ユーザーのIDを取得する
    $loginUserId = session('login_user_id');

    // ログイン中ユーザーIDがない場合の処理
    if ($loginUserId === null) {

        // ログインしていないのでログイン画面へ移動する
        return redirect('/login');

    // ログイン確認の条件分岐を終了する
    }

    // ログイン中ユーザーIDからユーザー情報を取得する
    $loginUser = User::find($loginUserId);

    // ログイン中ユーザーがDBに存在しない場合の処理
    if ($loginUser === null) {

        // セッションに残っているログイン中ユーザーIDを削除する
        session()->forget('login_user_id');

        // ログイン画面へ移動する
        return redirect('/login');

    // ユーザー存在確認の条件分岐を終了する
    }

    // profile-edit.blade.phpを表示し、ログイン中ユーザー情報を渡す
    return view('profile-edit', [

        // ログイン中ユーザー情報をビューに渡す
        'loginUser' => $loginUser,
    ]);

// プロフィール編集画面のルート処理を終了する
});

// フォロー処理を実行するルート
Route::post('/users/{user}/follow', [FollowController::class, 'store'])

    // このルートにusers.followという名前を付ける
    ->name('users.follow');

// フォロー解除処理を実行するルート
Route::delete('/users/{user}/follow', [FollowController::class, 'destroy'])

    // このルートにusers.unfollowという名前を付ける
    ->name('users.unfollow');