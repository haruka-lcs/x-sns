@extends('layouts.app')

@section('title', 'プロフィール')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="profile-page">
        <header class="profile-header">
            <h1>プロフィール</h1>
        </header>

        <section class="profile-user-area">
            <div class="profile-large-avatar"></div>

            <div class="profile-user-info">
                <div class="profile-user-text">
                    <p class="profile-user-name">
                        {{ $loginUser->user_name }}
                    </p>

                    <p class="profile-account-id">
                        {{ '@' . $loginUser->account_id }}
                    </p>
                </div>

                <a href="/profile/edit" class="profile-edit-button">
                    ✎
                </a>
            </div>
        </section>

        <main class="profile-post-list">
            @forelse ($posts as $post)
                <article class="profile-post-card">
                    <div class="profile-post-avatar"></div>

                    <div class="profile-post-content">
                        <div class="profile-post-header">
                            <span class="profile-post-user-name">
                                {{ $post->user->user_name }}
                            </span>

                            <span class="profile-post-account-id">
                                {{ '@' . $post->user->account_id }}
                            </span>

                            <span class="profile-post-time">
                                ・15分前
                            </span>
                        </div>

                        <p class="profile-post-body">
                            {{ $post->body }}
                        </p>
                    </div>

                    <form action="/posts/{{ $post->id }}" method="POST" class="profile-delete-form">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="profile-delete-button">
                            🗑
                        </button>
                    </form>
                </article>
            @empty
                <div class="profile-empty">
                    <p>まだ投稿がありません。</p>
                </div>
            @endforelse
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