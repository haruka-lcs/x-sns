@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="profile-edit-page">
        <header class="profile-edit-header">
            <h1>プロフィール</h1>
        </header>

        <form class="profile-edit-form" action="/profile" method="GET">
            <div class="profile-edit-avatar"></div>

            <div class="profile-edit-input-row">
                <label for="account_id">ユーザーID</label>
                <input
                    type="text"
                    id="account_id"
                    name="account_id"
                    value="tanaka"
                >
            </div>

            <div class="profile-edit-input-row">
                <label for="user_name">ユーザーネーム</label>
                <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    value="田中"
                >
            </div>

            <div class="profile-edit-input-row">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    value="1111"
                >
            </div>

            <button type="submit" class="profile-save-button">
                保存する
            </button>
        </form>

        <nav class="bottom-nav">
            <a href="/home" class="bottom-nav-item">
                <span class="nav-icon">⌂</span>
                <span>ホーム</span>
            </a>

            <a href="/post" class="bottom-nav-item">
                <span class="nav-icon">＋</span>
                <span>投稿</span>
            </a>

            <a href="/profile" class="bottom-nav-item active">
                <span class="nav-icon">♙</span>
                <span>プロフィール</span>
            </a>
        </nav>
    </div>
@endsection