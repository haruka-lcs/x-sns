<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/home', 'home');

/* デフォルトで / にアクセスしたら /login へ飛ばす */
Route::redirect('/', '/login');