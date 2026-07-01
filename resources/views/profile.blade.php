@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
    <div class="profile-page">
        <header class="profile-header">
            <h1>プロフィール</h1>
        </header>

        <section class="profile-user-area">
            <div class="profile-large-avatar"></div>

            <div class="profile-info">
                <div class="profile-name-row">
                    <div>
                        <p class="profile-user-name">{{ $loginUser->user_name }}</p>
                        <p class="profile-account-id">{{ '@' . $loginUser->account_id }}</p>
                    </div>

                    <a href="/profile/edit" class="profile-edit-button">✎</a>
                </div>
            </div>
        </section>

        <section class="profile-post-list">
            <x-post-card
                :user-name="$loginUser->user_name"
                :account-id="'@' . $loginUser->account_id"
                time="15分前"
                body="アプリを開発中です。"
                :show-delete="true"
            />

            <x-post-card
                :user-name="$loginUser->user_name"
                :account-id="'@' . $loginUser->account_id"
                time="15分前"
                body="画面実装できた"
                :show-delete="true"
            />

            <x-post-card
                :user-name="$loginUser->user_name"
                :account-id="'@' . $loginUser->account_id"
                time="15分前"
                body="今日も少し進めた"
                :show-delete="true"
            />
        </section>

        <x-bottom-nav active="profile" />
    </div>
@endsection