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
                <x-post-card
                    :userName="$post->user->user_name"
                    :accountId="$post->user->account_id"
                    :time="$post->created_at->timezone('Asia/Tokyo')->format('H:i')"
                    :body="$post->body"
                    :userId="$post->user_id"
                    :profileImage="$post->user->profile_image"
                    :canFollow="$loginUser->id !== $post->user_id"
                    :isFollowing="isset($followingUserIds) && in_array($post->user_id, $followingUserIds)"
                />
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