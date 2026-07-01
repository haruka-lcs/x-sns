@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="auth-page">
        <header class="auth-header">
            <h1>ログイン</h1>
        </header>

        <form class="auth-form" action="/home" method="GET">
            <div class="form-row">
                <label for="account_id">ユーザーID</label>
                <input type="text" id="account_id" name="account_id">
            </div>

            <div class="form-row">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="auth-submit-button">完了</button>
        </form>

        <a href="/" class="back-link">戻る</a>
    </div>
@endsection