@extends('layouts.app')
{{-- layouts/app.blade.php を土台として使う --}}

@section('title', '投稿')
{{-- ページタイトルに「投稿」を入れる --}}
{{-- layouts.app の @yield('title') に入る --}}

@section('css')
{{-- このページ専用のCSSを書く場所 --}}

    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    {{-- public/css/post.css を読み込む --}}
    {{-- 投稿画面専用のCSSを適用する --}}

@endsection
{{-- cssセクションの終わり --}}

@section('content')
{{-- 画面に表示する中身を書く場所 --}}
{{-- layouts.app の @yield('content') に入る --}}

    <div class="post-page">
        {{-- 投稿画面全体を囲む --}}
        {{-- post-pageクラスで投稿画面全体の見た目を整える --}}

        <header class="post-header">
            {{-- 投稿画面のヘッダー部分 --}}

            <h1>投稿</h1>
            {{-- 画面上部に「投稿」というタイトルを表示する --}}
        </header>

        <main class="post-main">
            {{-- 投稿画面のメイン部分 --}}
            {{-- 投稿フォームと投稿ボタンを入れる場所 --}}

            <form action="/posts" method="POST" id="post-form" class="post-form">
                {{-- 投稿フォーム --}}
                {{-- action="/posts" なので /posts に送信する --}}
                {{-- method="POST" なのでPOST送信する --}}
                {{-- id="post-form" は外側の投稿ボタンとフォームをつなげるために使う --}}
                {{-- post-formクラスでCSSを当てる --}}

                @csrf
                {{-- CSRF対策用のトークンを入れる --}}
                {{-- LaravelでPOST送信するときに必要 --}}

                <div class="post-input-row">
                    {{-- アイコンと入力欄を横並びにするためのエリア --}}

                    <div class="post-avatar"></div>
                    {{-- 投稿者アイコンを表示する場所 --}}
                    {{-- 今は画像ではなく空の丸アイコンとして表示している --}}

                    <div class="post-input-area">
                        {{-- 投稿入力欄とエラーメッセージをまとめる場所 --}}

                        <textarea
                            {{-- 複数行の文章を入力できるフォーム部品 --}}

                            name="body"
                            {{-- 入力された投稿本文を body という名前で送信する --}}
                            {{-- PostController の $request->body で受け取れる --}}

                            class="post-textarea"
                            {{-- textareaにCSSを当てる --}}

                            placeholder="いまどうしてる？"
                            {{-- 入力前に薄く表示される案内文 --}}

                            maxlength="140"
                            {{-- 入力できる文字数を最大140文字に制限する --}}
                        >{{ old('body') }}</textarea>
                        {{-- 前回送信時のbodyの入力内容を表示する --}}
                        {{-- バリデーションエラーで戻ってきたとき、入力内容が消えないようにする --}}

                        @error('body')
                            {{-- bodyにバリデーションエラーがある場合だけ中身を表示する --}}

                            <p class="post-error-message">{{ $message }}</p>
                            {{-- bodyのエラーメッセージを表示する --}}
                            {{-- post-error-messageクラスでエラー文の見た目を整える --}}

                        @enderror
                        {{-- エラー表示の条件分岐終了 --}}
                    </div>
                </div>
            </form>

            <button type="submit" form="post-form" class="post-submit-button">
                {{-- 投稿ボタン --}}
                {{-- type="submit" なのでフォームを送信するボタン --}}
                {{-- form="post-form" で id="post-form" のフォームとつながっている --}}
                {{-- ボタンがformタグの外にあっても、この指定でフォーム送信できる --}}
                {{-- post-submit-buttonクラスでCSSを当てる --}}

                投稿する
                {{-- ボタンに表示する文字 --}}
            </button>
        </main>

        <nav class="bottom-nav">
            {{-- 画面下のナビゲーション全体 --}}

            <a href="/home" class="bottom-nav-item">
                {{-- ホーム画面へ移動するリンク --}}
                {{-- bottom-nav-itemクラスでCSSを当てる --}}

                <div class="bottom-nav-icon">⌂</div>
                {{-- ホーム用のアイコンを表示する --}}

                <span>ホーム</span>
                {{-- 「ホーム」という文字を表示する --}}
            </a>

            <a href="/post" class="bottom-nav-item post-button active">
                {{-- 投稿画面へ移動するリンク --}}
                {{-- 今いるページが投稿画面なので active クラスが付いている --}}
                {{-- post-buttonクラスで投稿ボタン用の見た目を追加している --}}

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
@endsection
{{-- contentセクションの終わり --}}