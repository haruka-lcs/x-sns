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
            @forelse ($posts as $post)
                <x-post-card
                    :user-name="$post->user->user_name"
                    :account-id="'@' . $post->user->account_id"
                    :time="$post->created_at->timezone('Asia/Tokyo')->format('Y/m/d H:i')"
                    :body="$post->body"
                    :post-id="$post->id"
                    :can-delete="true"
                />
            @empty
                <p class="empty-post-message">
                    まだ投稿がありません。
                </p>
            @endforelse
        </section>

        <x-bottom-nav active="profile" />
    </div>
@endsection