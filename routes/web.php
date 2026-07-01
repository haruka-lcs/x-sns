<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('home');
});

// 投稿画面
Route::get('/post', function () {
    return view('post');
});

// プロフィール画面
Route::get('/profile', function () {
    return view('profile');
});

// プロフィール編集画面
Route::post('/profile/edit', function () {
    return redirect('/profile');
})->name('profile.update');

Route::get('/profile/edit', function () {
    return view('profile-edit');
});