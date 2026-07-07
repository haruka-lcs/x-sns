@extends('layouts.app')
{{-- layouts/app.blade.php を土台として使う --}}

@section('title', 'ホーム')
{{-- ページタイトルに「ホーム」を入れる --}}
{{-- layouts.app の @yield('title') に入る --}}

@section('css')
{{-- このページ専用のCSSを書く場所 --}}

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    {{-- public/css/home.css を読み込む --}}
    {{-- ホーム画面専用のCSSを適用する --}}

@endsection
{{-- cssセクションの終わり --}}

@section('content')
{{-- 画面に表示する中身を書く場所 --}}
{{-- layouts.app の @yield('content') に入る --}}

    <div class="home-page">
        {{-- ホーム画面全体を囲む --}}
        {{-- home-pageクラスでホーム画面全体の見た目を整える --}}

        <header class="home-header">
            {{-- ホーム画面のヘッダー部分 --}}

            <h1>ホーム</h1>
            {{-- 画面上部に「ホーム」というタイトルを表示する --}}
        </header>

        <nav class="home-tab-menu">
            {{-- 「全体」「フォロー中」のタブメニュー全体 --}}

            <a href="/home" class="home-tab {{ request()->is('home') ? 'active' : '' }}">
                {{-- /home に移動するリンク --}}
                {{-- home-tabクラスでタブの見た目を整える --}}
                {{-- 今のURLが home なら active クラスを付ける --}}
                {{-- active が付くと、今選択中のタブとして表示される --}}

                全体
                {{-- タブに「全体」と表示する --}}
            </a>

            <a href="/home/following" class="home-tab {{ request()->is('home/following') ? 'active' : '' }}">
                {{-- /home/following に移動するリンク --}}
                {{-- 今のURLが home/following なら active クラスを付ける --}}
                {{-- フォロー中タブを選択中の見た目にするための処理 --}}

                フォロー中
                {{-- タブに「フォロー中」と表示する --}}
            </a>
        </nav>

        <main class="home-post-list">
            {{-- 投稿一覧を表示するメインエリア --}}
            {{-- home-post-listクラスで投稿一覧の見た目を整える --}}

            @forelse ($posts as $post)
                {{-- $posts の中身を1件ずつ $post として取り出す --}}
                {{-- 投稿が1件以上ある場合は、この中の処理を繰り返す --}}
                {{-- 投稿が空の場合は @empty の中を表示する --}}

                <x-post-card
                    {{-- post-cardコンポーネントを呼び出す --}}
                    {{-- 投稿1件分の表示をこのコンポーネントに任せる --}}

                    :userName="$post->user->user_name"
                    {{-- 投稿者の表示名を post-card に渡す --}}
                    {{-- $post->user は投稿したユーザー情報 --}}
                    {{-- user_name は表示名 --}}

                    :accountId="$post->user->account_id"
                    {{-- 投稿者のアカウントIDを post-card に渡す --}}
                    {{-- 例：haru、tanaka など --}}

                    time="15分前"
                    {{-- 投稿時間として「15分前」を渡す --}}
                    {{-- 今は固定表示になっている --}}

                    :body="$post->body"
                    {{-- 投稿本文を post-card に渡す --}}

                    :userId="$post->user_id"
                    {{-- 投稿者のユーザーIDを post-card に渡す --}}
                    {{-- フォロー処理で使う --}}

                    :profileImage="$post->user->profile_image"
                    {{-- 投稿者のプロフィール画像パスを post-card に渡す --}}
                    {{-- 画像があれば表示される --}}

                    :canFollow="$loginUser->id !== $post->user_id"
                    {{-- フォローボタンを表示するかどうかを渡す --}}
                    {{-- ログイン中ユーザーのidと投稿者idが違う場合だけ true --}}
                    {{-- つまり、自分の投稿にはフォローボタンを出さない --}}

                    :isFollowing="isset($followingUserIds) && in_array($post->user_id, $followingUserIds)"
                    {{-- この投稿者をすでにフォローしているかどうかを渡す --}}
                    {{-- $followingUserIds が存在していて --}}
                    {{-- その中に投稿者idが含まれていれば true --}}
                    {{-- trueならフォロー済みボタンになる --}}
                />
                {{-- post-cardコンポーネントの呼び出し終了 --}}

            @empty
                {{-- $posts が空だった場合の表示 --}}

                <div class="home-empty">
                    {{-- 投稿がないときのメッセージエリア --}}

                    <p>まだ投稿がありません。</p>
                    {{-- 投稿がないことを表示する --}}
                </div>

            @endforelse
            {{-- 投稿一覧の繰り返し終了 --}}
        </main>

        <nav class="bottom-nav">
            {{-- 画面下のナビゲーション全体 --}}

            <a href="/home" class="bottom-nav-item active">
                {{-- ホーム画面へ移動するリンク --}}
                {{-- 今いるページがホームなので active クラスを付けている --}}

                <div class="bottom-nav-icon">⌂</div>
                {{-- ホーム用のアイコンを表示する --}}

                <span>ホーム</span>
                {{-- 「ホーム」という文字を表示する --}}
            </a>

            <a href="/post" class="bottom-nav-item post-button">
                {{-- 投稿画面へ移動するリンク --}}
                {{-- post-buttonクラスで投稿ボタン用の見た目を付けている --}}

                <div class="bottom-post-icon">＋</div>
                {{-- 投稿用の＋アイコンを表示する --}}

                <span>投稿</span>
                {{-- 「投稿」という文字を表示する --}}
            </a>

            <a href="/profile" class="bottom-nav-item">
                {{-- プロフィール画面へ移動するリンク --}}

                <div class="bottom-nav-icon">♙</div>
                {{-- プロフィール用のアイコンを表示する --}}

                <span>プロフィール</span>
                {{-- 「プロフィール」という文字を表示する --}}
            </a>
        </nav>
    </div>
    {{-- home-pageの終わり --}}

@endsection
{{-- contentセクションの終わり --}}