@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">
@endsection

@section('content')
    <div class="profile-edit-page">
        <header class="profile-edit-header">
            <h1>プロフィール</h1>
        </header>

        <main class="profile-edit-main">
            <form action="/profile/edit" method="POST" class="profile-edit-form">
                @csrf

                <div class="profile-edit-avatar"></div>

                <div class="profile-edit-form-area">
                    <div class="profile-edit-form-row">
                        <label for="account_id" class="profile-edit-label">
                            ユーザーID
                        </label>

                        <input
                            type="text"
                            id="account_id"
                            name="account_id"
                            class="profile-edit-input"
                            value="{{ old('account_id', $loginUser->account_id) }}"
                        >
                    </div>

                    @error('account_id')
                        <p class="profile-edit-error-message">{{ $message }}</p>
                    @enderror

                    <div class="profile-edit-form-row">
                        <label for="user_name" class="profile-edit-label">
                            ユーザーネーム
                        </label>

                        <input
                            type="text"
                            id="user_name"
                            name="user_name"
                            class="profile-edit-input"
                            value="{{ old('user_name', $loginUser->user_name) }}"
                        >
                    </div>

                    @error('user_name')
                        <p class="profile-edit-error-message">{{ $message }}</p>
                    @enderror

                    <div class="profile-edit-form-row">
                        <label for="password" class="profile-edit-label">
                            パスワード
                        </label>

                        <input
                            type="text"
                            id="password"
                            name="password"
                            class="profile-edit-input"
                            value="{{ old('password', $loginUser->password) }}"
                        >
                    </div>

                    @error('password')
                        <p class="profile-edit-error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="profile-edit-button-area">
                    <button type="submit" class="profile-edit-submit-button">
                        保存する
                    </button>
                </div>
            </form>
        </main>

        <nav class="bottom-nav">
            <a href="/home" class="bottom-nav-item">
                <div class="bottom-nav-icon">⌂</div>
                <span>ホーム</span>
            </a>

            <a href="/post" class="bottom-nav-item post-button">
                <div class="bottom-post-icon">＋</div>
                <span>投稿</span>
            </a>

            <a href="/profile" class="bottom-nav-item active">
                <div class="bottom-nav-icon">♙</div>
                <span>プロフィール</span>
            </a>
        </nav>
    </div>
@endsection