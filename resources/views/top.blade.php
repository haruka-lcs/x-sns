@extends('layouts.app')

@section('title', 'トップ')

@section('content')
    <div class="top-page">
        <a href="/login" class="top-button login-button">ログイン</a>
        <a href="/register" class="top-button register-button">新規登録</a>
    </div>
@endsection