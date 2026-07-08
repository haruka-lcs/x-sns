{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「ホーム」に設定する --}}
@section('title', 'ホーム')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/home.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- ホームページ全体を囲むエリア --}}
    <div class="home-page">

        {{-- ホームページのヘッダー部分 --}}
        <header class="home-header">

            {{-- ページタイトルとして「ホーム」を表示する --}}
            <h1>ホーム</h1>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- 「全体」と「フォロー中」を切り替えるタブメニュー --}}
        <nav class="home-tab-menu">

            {{-- 全体の投稿一覧ページへ移動するリンク --}}
            <a href="/home" class="home-tab {{ request()->is('home') ? 'active' : '' }}">

                {{-- タブに表示する文字 --}}
                全体

            {{-- 全体タブのリンクを閉じる --}}
            </a>

            {{-- フォロー中ユーザーの投稿一覧ページへ移動するリンク --}}
            <a href="/home/following" class="home-tab {{ request()->is('home/following') ? 'active' : '' }}">

                {{-- タブに表示する文字 --}}
                フォロー中

            {{-- フォロー中タブのリンクを閉じる --}}
            </a>

        {{-- タブメニューを閉じる --}}
        </nav>

        {{-- 投稿一覧を表示するメインエリア --}}
        <main class="home-post-list">

            {{-- postsの中身を1件ずつ取り出して表示する。投稿がない場合は@emptyを実行する --}}
            @forelse ($posts as $post)

                {{-- 投稿カードコンポーネントを表示する --}}
                <x-post-card

                    {{-- 投稿者の表示名をpost-cardに渡す --}}
                    :userName="$post->user->user_name"

                    {{-- 投稿者のアカウントIDをpost-cardに渡す --}}
                    :accountId="$post->user->account_id"

                    {{-- 投稿時間を日本時間に変換して「時:分」の形式でpost-cardに渡す --}}
                    :time="$post->created_at->timezone('Asia/Tokyo')->format('H:i')"

                    {{-- 投稿本文をpost-cardに渡す --}}
                    :body="$post->body"

                    {{-- 投稿者のユーザーIDをpost-cardに渡す --}}
                    :userId="$post->user_id"

                    {{-- 投稿者のプロフィール画像をpost-cardに渡す --}}
                    :profileImage="$post->user->profile_image"

                    {{-- ログイン中のユーザー本人の投稿でなければ、フォローボタンを表示する --}}
                    :canFollow="$loginUser->id !== $post->user_id"

                    {{-- followingIdsが存在し、投稿者IDがfollowingIdsの中にあればフォロー中として渡す --}}
                    :isFollowing="isset($followingIds) && in_array($post->user_id, $followingIds)"
                />

            {{-- 投稿が1件もない場合の表示 --}}
            @empty

                {{-- 投稿がない時のメッセージを囲むエリア --}}
                <div class="home-empty">

                    {{-- 投稿がないことを表示する --}}
                    <p>まだ投稿がありません。</p>

                {{-- 投稿なしメッセージのエリアを閉じる --}}
                </div>

            {{-- 投稿一覧の繰り返し処理を終了する --}}
            @endforelse

        {{-- 投稿一覧エリアを閉じる --}}
        </main>

        {{-- 画面下に表示するナビゲーション --}}
        <nav class="bottom-nav">

            {{-- ホーム画面へ移動するリンク。現在のページなのでactiveを付ける --}}
            <a href="/home" class="bottom-nav-item active">

                {{-- ホーム用のアイコンを表示する --}}
                <div class="bottom-nav-icon">⌂</div>

                {{-- ホームという文字を表示する --}}
                <span>ホーム</span>

            {{-- ホームリンクを閉じる --}}
            </a>

            {{-- 投稿画面へ移動するリンク --}}
            <a href="/post" class="bottom-nav-item post-button">

                {{-- 投稿用のアイコンを表示する --}}
                <div class="bottom-post-icon">＋</div>

                {{-- 投稿という文字を表示する --}}
                <span>投稿</span>

            {{-- 投稿リンクを閉じる --}}
            </a>

            {{-- プロフィール画面へ移動するリンク --}}
            <a href="/profile" class="bottom-nav-item">

                {{-- プロフィール用のアイコンを表示する --}}
                <div class="bottom-nav-icon">♙</div>

                {{-- プロフィールという文字を表示する --}}
                <span>プロフィール</span>

            {{-- プロフィールリンクを閉じる --}}
            </a>

        {{-- 下部ナビゲーションを閉じる --}}
        </nav>

    {{-- ホームページ全体を閉じる --}}
    </div>

{{-- contentセクションを終了する --}}
@endsection