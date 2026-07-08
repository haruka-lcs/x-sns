{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「投稿」に設定する --}}
@section('title', '投稿')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/post.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- 投稿ページ全体を囲むエリア --}}
    <div class="post-page">

        {{-- 投稿ページのヘッダー部分 --}}
        <header class="post-header">

            {{-- ページタイトルとして「投稿」を表示する --}}
            <h1>投稿</h1>

            {{-- 投稿フォームを送信するボタン --}}
            <button type="submit" form="post-form" class="post-submit-button">

                {{-- ボタンに表示する文字 --}}
                投稿する

            {{-- 投稿ボタンを閉じる --}}
            </button>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- 投稿内容を送信するためのフォーム --}}
        <form action="/posts" method="POST" id="post-form" class="post-form">

            {{-- 不正なフォーム送信を防ぐ --}}
            @csrf

            {{-- プロフィール画像と投稿入力欄をまとめるエリア --}}
            <div class="post-create-area">

                {{-- 投稿者のプロフィール画像を表示する枠 --}}
                <div class="post-avatar">

                    {{-- ログイン中のユーザーがいて、プロフィール画像も登録されている場合だけ画像を表示する --}}
                    @if ($loginUser && $loginUser->profile_image)

                        {{-- プロフィール画像を表示する --}}
                        <img

                            {{-- storageフォルダに保存されているプロフィール画像のURLを作る --}}
                            src="{{ asset('storage/' . $loginUser->profile_image) }}"

                            {{-- プロフィール画像用のCSSを当てる --}}
                            class="post-avatar-image"

                            {{-- 画像が表示されない時や読み上げ用の説明を設定する --}}
                            alt="プロフィール画像"

                        {{-- imgタグを閉じる --}}
                        >

                    {{-- プロフィール画像がある場合だけ表示する処理を終了する --}}
                    @endif

                {{-- プロフィール画像の枠を閉じる --}}
                </div>

                {{-- 投稿本文の入力欄を囲むエリア --}}
                <div class="post-input-area">

                    {{-- 投稿本文を入力するテキストエリア --}}
                    <textarea

                        {{-- 投稿本文として送信する名前をbodyにする --}}
                        name="body"

                        {{-- 投稿入力欄用のCSSを当てる --}}
                        class="post-textarea"

                        {{-- 入力前に表示する案内文を設定する --}}
                        placeholder="いまどうしてる？"

                        {{-- 入力できる文字数を140文字までに制限する --}}
                        maxlength="140"

                    {{-- バリデーションエラー時に、前回入力した本文を残して表示する --}}
                    >{{ old('body') }}</textarea>

                    {{-- bodyにバリデーションエラーがある場合だけ表示する --}}
                    @error('body')

                        {{-- エラーメッセージを表示する --}}
                        <p class="error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                {{-- 投稿入力エリアを閉じる --}}
                </div>

            {{-- 投稿作成エリアを閉じる --}}
            </div>

        {{-- 投稿フォームを閉じる --}}
        </form>

        {{-- 投稿画面下部のナビバー --}}
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

    {{-- 投稿ページ全体を閉じる --}}
    </div>

{{-- contentセクションを終了する --}}
@endsection