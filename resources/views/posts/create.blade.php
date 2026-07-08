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
        </header>

        {{-- 投稿ページのメイン部分 --}}
        <main class="post-main">

            {{-- 投稿内容を送信するためのフォーム --}}
            <form action="/posts" method="POST" id="post-form" class="post-form">

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- アイコンと入力欄を横並びにするエリア --}}
                <div class="post-input-row">

                    {{-- 投稿者のアイコンを表示するための枠 --}}
                    <div class="post-avatar"></div>

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
                            <p class="post-error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>

            {{-- 投稿フォームを送信するボタン --}}
            <button type="submit" form="post-form" class="post-submit-button">

                {{-- ボタンに表示する文字 --}}
                投稿する
            </button>
        </main>

        {{-- 画面下に表示するナビゲーション --}}
        <nav class="bottom-nav">

            {{-- ホーム画面へ移動するリンク --}}
            <a href="/home" class="bottom-nav-item">

                {{-- ホーム用のアイコンを表示する --}}
                <div class="bottom-nav-icon">⌂</div>

                {{-- ホームという文字を表示する --}}
                <span>ホーム</span>
            </a>

            {{-- 投稿画面へ移動するリンク。現在のページなのでactiveを付ける --}}
            <a href="/post" class="bottom-nav-item post-button active">

                {{-- 投稿用のアイコンを表示する --}}
                <div class="bottom-post-icon">＋</div>

                {{-- 投稿という文字を表示する --}}
                <span>投稿</span>
            </a>

            {{-- プロフィール画面へ移動するリンク --}}
            <a href="/profile" class="bottom-nav-item">

                {{-- プロフィール用のアイコンを表示する --}}
                <div class="bottom-nav-icon">♙</div>

                {{-- プロフィールという文字を表示する --}}
                <span>プロフィール</span>
            </a>
        </nav>
    </div>
@endsection