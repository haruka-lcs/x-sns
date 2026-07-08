{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「プロフィール」に設定する --}}
@section('title', 'プロフィール')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/profile.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- プロフィールページ全体を囲むエリア --}}
    <div class="profile-page">

        {{-- プロフィールページのヘッダー部分 --}}
        <header class="profile-header">

            {{-- ページタイトルとして「プロフィール」を表示する --}}
            <h1>プロフィール</h1>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- ログイン中ユーザーの情報を表示するエリア --}}
        <section class="profile-user-area">

            {{-- ログイン中ユーザーにプロフィール画像が登録されているか判定する --}}
            @if ($loginUser->profile_image)

                {{-- プロフィール画像を表示する --}}
                <img

                    {{-- storageフォルダに保存されているプロフィール画像のURLを作る --}}
                    src="{{ asset('storage/' . $loginUser->profile_image) }}"

                    {{-- 大きいプロフィール画像用のCSSを当てる --}}
                    class="profile-large-avatar"

                    {{-- 画像が表示されない時や読み上げ用の説明を設定する --}}
                    alt="プロフィール画像"
                >

            {{-- プロフィール画像が登録されていない場合の処理 --}}
            @else

                {{-- 画像なし用の空のアイコン枠を表示する --}}
                <div class="profile-large-avatar"></div>

            {{-- プロフィール画像の有無による条件分岐を終了する --}}
            @endif

            {{-- ユーザー名、アカウントID、編集ボタンをまとめるエリア --}}
            <div class="profile-user-info">

                {{-- ユーザー名とアカウントIDをまとめるエリア --}}
                <div class="profile-user-text">

                    {{-- ユーザー名を表示する段落 --}}
                    <p class="profile-user-name">

                        {{-- ログイン中ユーザーの表示名を表示する --}}
                        {{ $loginUser->user_name }}

                    {{-- ユーザー名の段落を閉じる --}}
                    </p>

                    {{-- アカウントIDを表示する段落 --}}
                    <p class="profile-account-id">

                        {{-- アカウントIDの前に@を付けて表示する --}}
                        {{ '@' . $loginUser->account_id }}

                    {{-- アカウントIDの段落を閉じる --}}
                    </p>

                {{-- ユーザー名とアカウントIDのエリアを閉じる --}}
                </div>

                {{-- プロフィール編集画面へ移動するリンク --}}
                <a href="/profile/edit" class="profile-edit-button">

                    {{-- 編集アイコンを表示する --}}
                    ✎

                {{-- プロフィール編集リンクを閉じる --}}
                </a>

            {{-- ユーザー情報エリアを閉じる --}}
            </div>

        {{-- ログイン中ユーザー情報エリアを閉じる --}}
        </section>

        {{-- 自分の投稿一覧を表示するメインエリア --}}
        <main class="profile-post-list">

            {{-- postsの中身を1件ずつ取り出して表示する。投稿がない場合は@emptyを実行する --}}
            @forelse ($posts as $post)

                {{-- 投稿1件分のカードを作る --}}
                <article class="profile-post-card">

                    {{-- 投稿者のプロフィール画像を表示する枠 --}}
                    <div class="profile-post-avatar">

                        {{-- 投稿者にプロフィール画像が登録されている場合だけ画像を表示する --}}
                        @if ($post->user->profile_image)

                            {{-- 投稿者のプロフィール画像を表示する --}}
                            <img

                                {{-- storageフォルダに保存されているプロフィール画像のURLを作る --}}
                                src="{{ asset('storage/' . $post->user->profile_image) }}"

                                {{-- 投稿カード内のプロフィール画像用CSSを当てる --}}
                                class="profile-post-avatar-image"

                                {{-- 画像が表示されない時や読み上げ用の説明を設定する --}}
                                alt="プロフィール画像"
                            >

                        {{-- 投稿者のプロフィール画像がある場合だけ表示する処理を終了する --}}
                        @endif

                    {{-- 投稿者のプロフィール画像枠を閉じる --}}
                    </div>

                    {{-- 投稿内容を表示するエリア --}}
                    <div class="profile-post-content">

                        {{-- 投稿者名、アカウントID、投稿時間を表示するエリア --}}
                        <div class="profile-post-header">

                            {{-- 投稿者の表示名を表示するタグ --}}
                            <span class="profile-post-user-name">

                                {{-- 投稿者の表示名を表示する --}}
                                {{ $post->user->user_name }}

                            {{-- 投稿者名のタグを閉じる --}}
                            </span>

                            {{-- 投稿者のアカウントIDを表示するタグ --}}
                            <span class="profile-post-account-id">

                                {{-- アカウントIDの前に@を付けて表示する --}}
                                {{ '@' . $post->user->account_id }}

                            {{-- アカウントIDのタグを閉じる --}}
                            </span>

                            {{-- 投稿時間を表示するタグ --}}
                            <span class="profile-post-time">

                                {{-- 現在時刻から見た投稿時間を「○分前」などの形で表示する --}}
                                ・{{ $post->created_at->diffForHumans() }}

                            {{-- 投稿時間のタグを閉じる --}}
                            </span>

                        {{-- 投稿ヘッダーを閉じる --}}
                        </div>

                        {{-- 投稿本文を表示する段落 --}}
                        <p class="profile-post-body">

                            {{-- 投稿本文を表示する --}}
                            {{ $post->body }}

                        {{-- 投稿本文の段落を閉じる --}}
                        </p>

                    {{-- 投稿内容エリアを閉じる --}}
                    </div>

                    {{-- 投稿を削除するためのフォーム --}}
                    <form action="/posts/{{ $post->id }}" method="POST" class="profile-delete-form">

                        {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                        @csrf

                        {{-- HTMLフォームではDELETEが直接使えないため、LaravelにDELETEリクエストとして扱わせる --}}
                        @method('DELETE')

                        {{-- 投稿削除ボタンを作る --}}
                        <button type="submit" class="profile-delete-button">

                            {{-- 削除アイコンを表示する --}}
                            🗑

                        {{-- 削除ボタンを閉じる --}}
                        </button>

                    {{-- 投稿削除フォームを閉じる --}}
                    </form>

                {{-- 投稿カードを閉じる --}}
                </article>

            {{-- 投稿が1件もない場合の表示 --}}
            @empty

                {{-- 投稿がない時のメッセージを囲むエリア --}}
                <div class="profile-empty">

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

            {{-- ホーム画面へ移動するリンク --}}
            <a href="/home" class="bottom-nav-item">

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

            {{-- プロフィール画面へ移動するリンク。現在のページなのでactiveを付ける --}}
            <a href="/profile" class="bottom-nav-item active">

                {{-- プロフィール用のアイコンを表示する --}}
                <div class="bottom-nav-icon">♙</div>

                {{-- プロフィールという文字を表示する --}}
                <span>プロフィール</span>

            {{-- プロフィールリンクを閉じる --}}
            </a>

        {{-- 下部ナビゲーションを閉じる --}}
        </nav>

    {{-- プロフィールページ全体を閉じる --}}
    </div>

{{-- contentセクションを終了する --}}
@endsection