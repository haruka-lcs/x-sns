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
    <x-post-card
        user-name="田中"
        account-id="@tanaka"
        time="15分前"
        body="アプリを開発中です。"
    />

    <x-post-card
        user-name="佐藤"
        account-id="@sato"
        time="15分前"
        body="勉強中"
    />

    <x-post-card
        user-name="鈴木"
        account-id="@suzuki"
        time="15分前"
        body="画面実装できた"
    />

    <x-post-card
        user-name="伊藤"
        account-id="@ito"
        time="15分前"
        body="今日は少し進んだ"
    />
</section>

        <x-bottom-nav active="home" />
    </div>
@endsection