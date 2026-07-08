@extends('layouts.app')

@section('title', '投稿')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
    <div class="post-page">
        <header class="post-header">
            <h1>投稿</h1>

            <button type="submit" form="post-form" class="post-submit-button">
                投稿する
            </button>
        </header>

        <form action="/posts" method="POST" id="post-form" class="post-form">
            @csrf

            <div class="post-create-area">
                <div class="post-avatar">
                    @if ($loginUser && $loginUser->profile_image)
                        <img
                            src="{{ asset('storage/' . $loginUser->profile_image) }}"
                            class="post-avatar-image"
                            alt="プロフィール画像"
                        >
                    @endif
                </div>

                <div class="post-input-area">
                    <textarea
                        name="body"
                        class="post-textarea"
                        placeholder="いまどうしてる？"
                        maxlength="140"
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>

        <nav class="bottom-nav">
            <a href="/home" class="bottom-nav-item">
                <div class="bottom-nav-icon">⌂</div>
                <span>ホーム</span>
            </a>

            <a href="/post" class="bottom-nav-item post-button active">
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