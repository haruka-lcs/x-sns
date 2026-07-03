@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="home-page">
        <header class="home-header">
            <h1>ホーム</h1>
        </header>

        <nav class="home-tabs">
            <a href="/home" class="home-tab {{ request()->is('home') ? 'active' : '' }}">
                全体
            </a>

            <a href="/home/following" class="home-tab {{ request()->is('home/following') ? 'active' : '' }}">
                フォロー中
            </a>
        </nav>

        <section class="post-create-area">
            <form action="/posts" method="POST" class="post-form">
                @csrf

                <div class="post-form-user">
                    <div class="post-avatar"></div>

                    <div class="post-form-content">
                        <textarea
                            name="body"
                            class="post-textarea"
                            placeholder="いまどうしてる？"
                            maxlength="140"
                        >{{ old('body') }}</textarea>

                        @error('body')
                            <p class="error-message">{{ $message }}</p>
                        @enderror

                        <div class="post-form-footer">
                            <p class="character-count">
                                最大140文字
                            </p>

                            <button type="submit" class="post-submit-button">
                                投稿
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <section class="post-list">
            @forelse ($posts as $post)
                <article class="post-card">
                    <div class="post-card-avatar"></div>

                    <div class="post-card-body">
                        <div class="post-card-header">
                            <div>
                                <p class="post-user-name">
                                    {{ $post->user->user_name }}
                                </p>

                                <p class="post-account-id">
                                    {{ '@' . $post->user->account_id }}
                                </p>
                            </div>

                            <p class="post-created-at">
                                {{ $post->created_at->format('Y/m/d H:i') }}
                            </p>
                        </div>

                        <p class="post-body">
                            {{ $post->body }}
                        </p>

                        @if ($post->user_id === session('login_user_id'))
                            <form action="/posts/{{ $post->id }}" method="POST" class="post-delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="post-delete-button">
                                    削除
                                </button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-posts">
                    <p>まだ投稿がありません。</p>
                </div>
            @endforelse
        </section>
    </div>
@endsection