@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="auth-page">
        <header class="auth-header">
            <h1>ログイン</h1>
        </header>

        <form class="auth-form" action="{{ route('login.check') }}" method="POST">
            @csrf

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
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                >
            </div>

            @if ($errors->any())
                <div class="error-message">
                    ユーザーIDまたはパスワードが違います
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