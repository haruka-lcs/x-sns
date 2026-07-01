@extends('layouts.app')

@section('title', '新規登録')

@section('content')
    <div class="register-page">
        <header class="auth-header">
            <h1>新規登録</h1>
        </header>

        <form class="register-form" action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="profile-image-placeholder"></div>

            <div class="form-row">
                <label for="account_id">ユーザーID</label>
                <input
                    type="text"
                    id="account_id"
                    name="account_id"
                    value="{{ old('account_id') }}"
                >
            </div>

            <div class="form-row">
                <label for="user_name">ユーザーネーム</label>
                <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    value="{{ old('user_name') }}"
                >
            </div>

            <div class="form-row">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                >
            </div>

            @if ($errors->any())
                <div class="error-message">
                    入力内容を確認してください
                </div>
            @endif

            <button type="submit" class="auth-submit-button">
                完了
            </button>
        </form>

        <a href="/" class="back-link">
            戻る
        </a>
    </div>
@endsection