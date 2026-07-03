@extends('layouts.app')

@section('title', 'ホーム')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="home-page">
        <header class="home-header">
            <h1>ホーム</h1>
        </header>

        <nav class="home-tab-menu">
            <a href="/home" class="home-tab {{ request()->is('home') ? 'active' : '' }}">
                全体
            </a>

            <a href="/home/following" class="home-tab {{ request()->is('home/following') ? 'active' : '' }}">
                フォロー中
            </a>
        </nav>

        <main class="home-post-list">
            @forelse ($posts as $post)
                <article class="home-post-card">
                    <div class="home-avatar-area">
                        <div class="home-avatar"></div>

                        @if (isset($followingUserIds) && in_array($post->user_id, $followingUserIds))
                            <span class="home-follow-mark">✓</span>
                        @else
                            <span class="home-follow-mark">＋</span>
                        @endif
                    </div>

                    <div class="home-post-content">
                        <div class="home-post-header">
                            <span class="home-user-name">
                                {{ $post->user->user_name }}
                            </span>

                            <span class="home-account-id">
                                {{ '@' . $post->user->account_id }}
                            </span>

                            <span class="home-post-time">
                                ・15分前
                            </span>
                        </div>

                        <p class="home-post-body">
                            {{ $post->body }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="home-empty">
                    <p>まだ投稿がありません。</p>
                </div>
            @endforelse
        </main>

        <nav class="bottom-nav">
            <a href="/home" class="bottom-nav-item active">
                <div class="bottom-nav-icon">⌂</div>
                <span>ホーム</span>
            </a>

            <a href="/post" class="bottom-nav-item post-button">
                <div class="bottom-post-icon">＋</div>
                <span>投稿</span>
            </a>

            <a href="/profile" class="bottom-nav-item">
                <div class="bottom-nav-icon">♙</div>
                <span>プロフィール</span>
            </a>
        </nav>
    </div>
@endsection