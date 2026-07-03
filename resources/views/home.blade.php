@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="home-page">
        <header class="home-header">
            <h1>ホーム</h1>
        </header>

        <div class="home-tabs">
            <button class="home-tab active">全体</button>
            <button class="home-tab">フォロー中</button>
        </div>

        <section class="post-list">
            @forelse ($posts as $post)
                <x-post-card
                    :user-name="$post->user->user_name"
                    :account-id="'@' . $post->user->account_id"
                    :time="$post->created_at->format('Y/m/d H:i')"
                    :body="$post->body"
                />
            @empty
                <p class="empty-post-message">
                    まだ投稿がありません。
                </p>
            @endforelse
        </section>

        <x-bottom-nav active="home" />
    </div>
@endsection