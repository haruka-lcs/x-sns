<?php

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// トップ画面
Route::get('/', function () {
    return view('top');
});

// ログイン画面
Route::get('/login', function () {
    return view('login');
});

// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->name('login.check');

// 新規登録画面
Route::get('/register', function () {
    return view('register');
});

// 新規登録処理
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// ホーム画面
Route::get('/home', function () {
    $loginUser = User::find(session('login_user_id'));

    $posts = Post::with('user')
        ->latest()
        ->get();

    return view('home', compact('loginUser', 'posts'));
});

// 投稿画面
Route::get('/post', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// 投稿削除
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// プロフィール画面
Route::get('/profile', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $posts = Post::with('user')
        ->where('user_id', $loginUserId)
        ->latest()
        ->get();

    return view('profile', [
        'loginUser' => $loginUser,
        'posts' => $posts,
    ]);
});

// プロフィール編集画面
Route::post('/profile/edit', function (Request $request) {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $request->validate([
        'account_id' => 'required|max:50|unique:users,account_id,' . $loginUser->id,
        'user_name' => 'required|max:50',
        'password' => 'required|max:50',
    ]);

    $loginUser->update([
        'account_id' => $request->account_id,
        'user_name' => $request->user_name,
        'password' => $request->password,
    ]);

    return redirect('/profile');
})->name('profile.update');

Route::get('/profile/edit', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    return view('profile-edit', [
        'loginUser' => $loginUser,
    ]);
});