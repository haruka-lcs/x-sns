<?php

use Illuminate\Support\Facades\Route;

// トップ画面
Route::get('/', function () {
    return view('top');
});

// ログイン画面
Route::get('/login', function () {
    return view('login');
});

// 新規登録画面
Route::get('/register', function () {
    return view('register');
});

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