<?php
// PHPファイルの開始

use Illuminate\Http\Request;
// フォームから送られてきた値を受け取るRequestを使う

use Illuminate\Support\Facades\Route;
// URLと処理をつなげるRouteを使う

use App\Models\Post;
// postsテーブルを操作するPostモデルを使う

use App\Models\User;
// usersテーブルを操作するUserモデルを使う

use App\Models\Follow;
// followsテーブルを操作するFollowモデルを使う

use App\Http\Controllers\AuthController;
// ログイン処理をまとめたAuthControllerを使う

use App\Http\Controllers\PostController;
// 投稿処理をまとめたPostControllerを使う

use App\Http\Controllers\FollowController;
// フォロー処理をまとめたFollowControllerを使う


// トップ画面
Route::get('/', function () {
    // 「/」にGETでアクセスされたときの処理

    return view('top');
    // top.blade.phpを表示する
});


// ログイン画面
Route::get('/login', function () {
    // 「/login」にGETでアクセスされたときの処理

    return view('login');
    // login.blade.phpを表示する
});


// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->name('login.check');
// 「/login」にPOSTで送信されたら、AuthControllerのloginメソッドを実行する
// このルートに login.check という名前をつける


// 新規登録画面
Route::get('/register', function () {
    // 「/register」にGETでアクセスされたときの処理

    return view('register');
    // register.blade.phpを表示する
});


// 新規登録処理
Route::post('/register', function (Request $request) {
    // 「/register」にPOSTで送信されたときの処理
    // $requestには新規登録フォームの入力内容が入る

    $request->validate([
        // フォームの入力チェックをする

        'account_id' => ['required', 'string', 'max:50', 'unique:users,account_id'],
        // account_idは必須
        // 文字列である必要がある
        // 最大50文字まで
        // usersテーブルのaccount_idと重複してはいけない

        'user_name' => ['required', 'string', 'max:50'],
        // user_nameは必須
        // 文字列である必要がある
        // 最大50文字まで

        'password' => ['required', 'string'],
        // passwordは必須
        // 文字列である必要がある

        'profile_image' => ['nullable', 'image', 'max:2048'],
        // profile_imageは未入力でもOK
        // 入力された場合は画像ファイルである必要がある
        // 最大2048KBまで
    ]);

    $profileImagePath = null;
    // プロフィール画像の保存先を入れる変数を用意する
    // 最初は画像がない状態なのでnullにする

    if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
        // profile_imageが送られているか確認する
        // さらに、そのファイルが正常にアップロードされているか確認する

        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        // 画像を storage/app/public/profile_images に保存する
        // 保存された画像パスを $profileImagePath に入れる
    }

    $user = User::create([
        // usersテーブルに新しいユーザーを作成する

        'account_id' => $request->account_id,
        // フォームに入力されたaccount_idを保存する

        'user_name' => $request->user_name,
        // フォームに入力されたuser_nameを保存する

        'password' => $request->password,
        // フォームに入力されたpasswordを保存する
        // 今はハッシュ化せず、そのまま保存している

        'profile_image' => $profileImagePath,
        // プロフィール画像の保存パスを保存する
        // 画像がない場合はnullが入る
    ]);

    session(['login_user_id' => $user->id]);
    // 作成したユーザーのidをセッションに保存する
    // これで新規登録後にログイン中として扱える

    return redirect('/home');
    // 新規登録が終わったらホーム画面へ移動する
});


// ホーム画面：全体
Route::get('/home', function () {
    // 「/home」にGETでアクセスされたときの処理

    $loginUserId = session('login_user_id');
    // セッションからログイン中のユーザーidを取得する

    if ($loginUserId === null) {
        // ログイン中のユーザーidがなければ

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $loginUser = User::find($loginUserId);
    // usersテーブルからログイン中のユーザー情報を取得する

    if ($loginUser === null) {
        // セッションにはidがあるけど、DBにそのユーザーが存在しない場合

        session()->forget('login_user_id');
        // セッションからlogin_user_idを削除する

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $posts = Post::with('user')
        // postsテーブルから投稿を取得する
        // with('user')で投稿者のユーザー情報も一緒に取得する

        ->latest()
        // 新しい投稿順に並べる

        ->get();
        // 投稿一覧を取得する

    $followingIds = Follow::where('follower_id', $loginUserId)
        // followsテーブルから、自分がフォローしているデータを探す
        // follower_idがログイン中ユーザーidのデータを探す

        ->pluck('followed_id')
        // followed_idだけを取り出す
        // つまり、自分がフォローしているユーザーidだけを取り出す

        ->toArray();
        // 取り出したデータを配列に変換する

    return view('home', [
        // home.blade.phpを表示する
        // 画面で使うデータを一緒に渡す

        'loginUser' => $loginUser,
        // ログイン中のユーザー情報を渡す

        'posts' => $posts,
        // 全体の投稿一覧を渡す

        'followingIds' => $followingIds,
        // 自分がフォローしているユーザーid一覧を渡す

        'activeTab' => 'all',
        // 今表示しているタブが「全体」だと分かるように渡す

        'emptyMessage' => 'まだ投稿がありません。',
        // 投稿が1件もないときに表示するメッセージを渡す
    ]);
})->name('home');
// このルートに home という名前をつける


// ホーム画面：フォロー中
Route::get('/home/following', function () {
    // 「/home/following」にGETでアクセスされたときの処理

    $loginUserId = session('login_user_id');
    // セッションからログイン中のユーザーidを取得する

    if ($loginUserId === null) {
        // ログイン中のユーザーidがなければ

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $loginUser = User::find($loginUserId);
    // usersテーブルからログイン中のユーザー情報を取得する

    if ($loginUser === null) {
        // セッションにはidがあるけど、DBにそのユーザーが存在しない場合

        session()->forget('login_user_id');
        // セッションからlogin_user_idを削除する

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $followingIds = Follow::where('follower_id', $loginUserId)
        // followsテーブルから、自分がフォローしているデータを探す

        ->pluck('followed_id')
        // 自分がフォローしている相手のユーザーidだけを取り出す

        ->toArray();
        // 配列に変換する

    $posts = Post::with('user')
        // postsテーブルから投稿を取得する
        // 投稿者のユーザー情報も一緒に取得する

        ->whereIn('user_id', $followingIds)
        // user_idが$followingIdsの中にある投稿だけ取得する
        // つまり、フォロー中ユーザーの投稿だけに絞る

        ->latest()
        // 新しい投稿順に並べる

        ->get();
        // 投稿一覧を取得する

    return view('home', [
        // home.blade.phpを表示する
        // 画面で使うデータを一緒に渡す

        'loginUser' => $loginUser,
        // ログイン中のユーザー情報を渡す

        'posts' => $posts,
        // フォロー中ユーザーの投稿一覧を渡す

        'followingIds' => $followingIds,
        // 自分がフォローしているユーザーid一覧を渡す

        'activeTab' => 'following',
        // 今表示しているタブが「フォロー中」だと分かるように渡す

        'emptyMessage' => 'フォロー中の投稿はまだありません。',
        // フォロー中ユーザーの投稿がないときのメッセージを渡す
    ]);
})->name('home.following');
// このルートに home.following という名前をつける


// 投稿画面
Route::get('/post', [PostController::class, 'create'])->name('posts.create');
// 「/post」にGETでアクセスされたらPostControllerのcreateメソッドを実行する
// 投稿作成画面を表示するためのルート
// このルートに posts.create という名前をつける


// 投稿保存
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// 「/posts」にPOSTで送信されたらPostControllerのstoreメソッドを実行する
// 投稿内容をDBに保存するためのルート
// このルートに posts.store という名前をつける


// 投稿削除
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// 「/posts/{post}」にDELETEで送信されたらPostControllerのdestroyメソッドを実行する
// {post}には削除したい投稿のidが入る
// 投稿を削除するためのルート
// このルートに posts.destroy という名前をつける


// プロフィール画面
Route::get('/profile', function () {
    // 「/profile」にGETでアクセスされたときの処理

    $loginUserId = session('login_user_id');
    // セッションからログイン中のユーザーidを取得する

    if ($loginUserId === null) {
        // ログイン中のユーザーidがなければ

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $loginUser = User::find($loginUserId);
    // usersテーブルからログイン中のユーザー情報を取得する

    if ($loginUser === null) {
        // セッションにはidがあるけど、DBにそのユーザーが存在しない場合

        session()->forget('login_user_id');
        // セッションからlogin_user_idを削除する

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $posts = Post::with('user')
        // postsテーブルから投稿を取得する
        // 投稿者のユーザー情報も一緒に取得する

        ->where('user_id', $loginUserId)
        // ログイン中ユーザーが投稿したものだけに絞る

        ->latest()
        // 新しい投稿順に並べる

        ->get();
        // 自分の投稿一覧を取得する

    return view('profile', [
        // profile.blade.phpを表示する
        // 画面で使うデータを一緒に渡す

        'loginUser' => $loginUser,
        // ログイン中のユーザー情報を渡す

        'posts' => $posts,
        // 自分の投稿一覧を渡す
    ]);
});


// プロフィール編集画面
Route::get('/profile/edit', function () {
    // 「/profile/edit」にGETでアクセスされたときの処理

    $loginUserId = session('login_user_id');
    // セッションからログイン中のユーザーidを取得する

    if ($loginUserId === null) {
        // ログイン中のユーザーidがなければ

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $loginUser = User::find($loginUserId);
    // usersテーブルからログイン中のユーザー情報を取得する

    if ($loginUser === null) {
        // セッションにはidがあるけど、DBにそのユーザーが存在しない場合

        session()->forget('login_user_id');
        // セッションからlogin_user_idを削除する

        return redirect('/login');
        // ログイン画面へ移動する
    }

    return view('profile-edit', [
        // profile-edit.blade.phpを表示する
        // 画面で使うデータを一緒に渡す

        'loginUser' => $loginUser,
        // 編集画面にログイン中のユーザー情報を渡す
    ]);
});


// プロフィール更新処理
Route::post('/profile/edit', function (Request $request) {
    // 「/profile/edit」にPOSTで送信されたときの処理
    // プロフィール編集フォームの内容を保存する処理

    $loginUserId = session('login_user_id');
    // セッションからログイン中のユーザーidを取得する

    if ($loginUserId === null) {
        // ログイン中のユーザーidがなければ

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $loginUser = User::find($loginUserId);
    // usersテーブルからログイン中のユーザー情報を取得する

    if ($loginUser === null) {
        // セッションにはidがあるけど、DBにそのユーザーが存在しない場合

        session()->forget('login_user_id');
        // セッションからlogin_user_idを削除する

        return redirect('/login');
        // ログイン画面へ移動する
    }

    $request->validate([
        // プロフィール編集フォームの入力チェックをする

        'account_id' => 'required|max:50|unique:users,account_id,' . $loginUser->id,
        // account_idは必須
        // 最大50文字まで
        // usersテーブルのaccount_idと重複してはいけない
        // ただし、自分自身のaccount_idは重複扱いにしない

        'user_name' => 'required|max:50',
        // user_nameは必須
        // 最大50文字まで

        'password' => 'required|max:50',
        // passwordは必須
        // 最大50文字まで
    ]);

    $loginUser->update([
        // ログイン中ユーザーの情報を更新する

        'account_id' => $request->account_id,
        // フォームに入力されたaccount_idで更新する

        'user_name' => $request->user_name,
        // フォームに入力されたuser_nameで更新する

        'password' => $request->password,
        // フォームに入力されたpasswordで更新する
        // 今はハッシュ化せず、そのまま保存している
    ]);

    return redirect('/profile');
    // 更新が終わったらプロフィール画面へ移動する
})->name('profile.update');
// このルートに profile.update という名前をつける


// フォロー処理
Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('users.follow');
// 「/users/{user}/follow」にPOSTで送信されたらFollowControllerのstoreメソッドを実行する
// {user}にはフォローしたいユーザーのidが入る
// フォローするためのルート
// このルートに users.follow という名前をつける


// フォロー解除処理
Route::delete('/users/{user}/follow', [FollowController::class, 'destroy'])->name('users.unfollow');
// 「/users/{user}/follow」にDELETEで送信されたらFollowControllerのdestroyメソッドを実行する
// {user}にはフォロー解除したいユーザーのidが入る
// フォロー解除するためのルート
// このルートに users.unfollow という名前をつける