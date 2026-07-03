@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="profile-edit-page">
        <header class="profile-edit-header">
            <h1>プロフィール</h1>
        </header>

        <form class="profile-edit-form" action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="profile-edit-avatar"></div>

            <div class="profile-edit-input-row">
                <label for="account_id">ユーザーID</label>
                <input
                    type="text"
                    id="account_id"
                    name="account_id"
                    value="{{ old('account_id', $loginUser->account_id) }}"
                >
            </div>

            <div class="profile-edit-input-row">
                <label for="user_name">ユーザーネーム</label>
                <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    value="{{ old('user_name', $loginUser->user_name) }}"
                >
            </div>

            <div class="profile-edit-input-row">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    value="{{ old('password', $loginUser->password) }}"
                >
            </div>

            @if ($errors->any())
                <div class="error-message">
                    入力内容を確認してください
                </div>
            @endif

            <button type="submit" class="profile-save-button">
                保存する
            </button>
        </form>

        <x-bottom-nav active="profile" />
    </div>
@endsection