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
                        <p class="profile-user-name">田中</p>
                        <p class="profile-account-id">@tanaka</p>
                    </div>

                    <a href="#" class="profile-edit-button">✎</a>
                </div>
            </div>
        </section>

        <section class="profile-post-list">
            <article class="profile-post-card">
                <div class="profile-post-avatar"></div>

                <div class="profile-post-content">
                    <div class="profile-post-meta">
                        <span class="profile-post-user-name">田中</span>
                        <span class="profile-post-account-id">@tanaka</span>
                        <span class="profile-post-time">15分前</span>
                    </div>

                    <p class="profile-post-text">
                        アプリを開発中です。
                    </p>
                </div>

                <button type="button" class="delete-post-button">🗑</button>
            </article>

            <article class="profile-post-card">
                <div class="profile-post-avatar"></div>

                <div class="profile-post-content">
                    <div class="profile-post-meta">
                        <span class="profile-post-user-name">田中</span>
                        <span class="profile-post-account-id">@tanaka</span>
                        <span class="profile-post-time">15分前</span>
                    </div>

                    <p class="profile-post-text">
                        画面実装できた
                    </p>
                </div>

                <button type="button" class="delete-post-button">🗑</button>
            </article>

            <article class="profile-post-card">
                <div class="profile-post-avatar"></div>

                <div class="profile-post-content">
                    <div class="profile-post-meta">
                        <span class="profile-post-user-name">田中</span>
                        <span class="profile-post-account-id">@tanaka</span>
                        <span class="profile-post-time">15分前</span>
                    </div>

                    <p class="profile-post-text">
                        今日も少し進めた
                    </p>
                </div>

                <button type="button" class="delete-post-button">🗑</button>
            </article>
        </section>

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