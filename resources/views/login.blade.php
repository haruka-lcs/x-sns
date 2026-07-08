@extends('layouts.app')

@section('title', 'ログイン')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login-page">
        <header class="login-header">
            <h1>ログイン</h1>
        </header>

        <main class="login-main">
            <form action="/login" method="POST" class="login-form">
                @csrf

                <div class="login-form-row">
                    <label for="account_id" class="login-label">
                        ユーザーID
                    </label>

                    <input
                        type="text"
                        id="account_id"
                        name="account_id"
                        class="login-input"
                        value="{{ old('account_id') }}"
                    >
                </div>

                <div class="login-form-row">
                    <label for="password" class="login-label">
                        パスワード
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="login-input"
                    >
                </div>

                @if ($errors->any())
                    <p class="login-error-message">
                        ユーザーIDまたはパスワードが正しくありません。
                    </p>
                @endif

                <div class="login-button-area">
                    <button type="submit" class="login-submit-button">
                        完了
                    </button>

                    <a href="/" class="login-back-link">
                        戻る
                    </a>
                </div>
            </form>
        </main>
    </div>
@endsection