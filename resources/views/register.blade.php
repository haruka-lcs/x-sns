@extends('layouts.app')

@section('title', '新規登録')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register-page">
        <header class="register-header">
            <h1>新規登録</h1>
        </header>

        <main class="register-main">
            <form action="/register" method="POST" class="register-form">
                @csrf

                <div class="register-avatar"></div>

                <div class="register-form-area">
                    <div class="register-form-row">
                        <label for="account_id" class="register-label">
                            ユーザーID
                        </label>

                        <input
                            type="text"
                            id="account_id"
                            name="account_id"
                            class="register-input"
                            value="{{ old('account_id') }}"
                        >
                    </div>

                    @error('account_id')
                        <p class="register-error-message">{{ $message }}</p>
                    @enderror

                    <div class="register-form-row">
                        <label for="user_name" class="register-label">
                            ユーザーネーム
                        </label>

                        <input
                            type="text"
                            id="user_name"
                            name="user_name"
                            class="register-input"
                            value="{{ old('user_name') }}"
                        >
                    </div>

                    @error('user_name')
                        <p class="register-error-message">{{ $message }}</p>
                    @enderror

                    <div class="register-form-row">
                        <label for="password" class="register-label">
                            パスワード
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="register-input"
                        >
                    </div>

                    @error('password')
                        <p class="register-error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="register-button-area">
                    <button type="submit" class="register-submit-button">
                        完了
                    </button>

                    <a href="/" class="register-back-link">
                        戻る
                    </a>
                </div>
            </form>
        </main>
    </div>
@endsection