@extends('layouts.app')

@section('title', '投稿')

@section('content')
    <div class="post-page">
        <header class="post-header">
            <h1>投稿</h1>
        </header>

        <form class="post-form" action="/home" method="GET">
            <div class="post-compose">
                <div class="compose-avatar"></div>

                <textarea
                    name="body"
                    class="compose-textarea"
                    placeholder="いまどうしてる？"
                ></textarea>
            </div>

            <button type="submit" class="post-submit-button">
                投稿する
            </button>
        </form>

        <nav class="bottom-nav">
            <a href="/home" class="bottom-nav-item">
                <span class="nav-icon">⌂</span>
                <span>ホーム</span>
            </a>

            <a href="/post" class="bottom-nav-item active">
                <span class="nav-icon">＋</span>
                <span>投稿</span>
            </a>

            <a href="/profile" class="bottom-nav-item">
                <span class="nav-icon">♙</span>
                <span>プロフィール</span>
            </a>
        </nav>
    </div>
@endsection