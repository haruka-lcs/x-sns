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
            <article class="post-card">
                <div class="post-avatar"></div>

                <div class="post-content">
                    <div class="post-meta">
                        <span class="post-user-name">田中</span>
                        <span class="post-account-id">@tanaka</span>
                        <span class="post-time">15分前</span>
                    </div>

                    <p class="post-text">
                        アプリを開発中です。
                    </p>
                </div>
            </article>

            <article class="post-card">
                <div class="post-avatar"></div>

                <div class="post-content">
                    <div class="post-meta">
                        <span class="post-user-name">佐藤</span>
                        <span class="post-account-id">@sato</span>
                        <span class="post-time">15分前</span>
                    </div>

                    <p class="post-text">
                        勉強中
                    </p>
                </div>
            </article>

            <article class="post-card">
                <div class="post-avatar"></div>

                <div class="post-content">
                    <div class="post-meta">
                        <span class="post-user-name">鈴木</span>
                        <span class="post-account-id">@suzuki</span>
                        <span class="post-time">15分前</span>
                    </div>

                    <p class="post-text">
                        画面実装できた
                    </p>
                </div>
            </article>

            <article class="post-card">
                <div class="post-avatar"></div>

                <div class="post-content">
                    <div class="post-meta">
                        <span class="post-user-name">伊藤</span>
                        <span class="post-account-id">@ito</span>
                        <span class="post-time">15分前</span>
                    </div>

                    <p class="post-text">
                        今日は少し進んだ
                    </p>
                </div>
            </article>
        </section>

        <x-bottom-nav active="home" />
    </div>
@endsection