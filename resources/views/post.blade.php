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
        {{-- post-pageクラスで画面全体の見た目を整える --}}

        <header class="post-header">
            {{-- 投稿画面のヘッダー部分 --}}
            {{-- タイトルと投稿ボタンを入れる場所 --}}

            <h1>投稿</h1>
            {{-- 画面上部に「投稿」というタイトルを表示する --}}

            <button type="submit" form="post-form" class="post-submit-button">
                {{-- 投稿ボタン --}}
                {{-- type="submit" なのでフォームを送信するボタン --}}
                {{-- form="post-form" で id="post-form" のフォームとつながる --}}
                {{-- ボタンがformタグの外にあっても、この指定でフォーム送信できる --}}
                {{-- post-submit-buttonクラスでCSSを当てる --}}

                投稿する
                {{-- ボタンに表示する文字 --}}
            </button>
        </header>

        <form action="/posts" method="POST" id="post-form" class="post-form">
            {{-- 投稿フォーム --}}
            {{-- action="/posts" なので /posts に送信する --}}
            {{-- method="POST" なのでPOST送信する --}}
            {{-- id="post-form" は上の投稿ボタンとフォームをつなげるために使う --}}
            {{-- post-formクラスでCSSを当てる --}}

            @csrf
            {{-- CSRF対策用のトークンを入れる --}}
            {{-- LaravelでPOST送信するときに必要 --}}

            <div class="post-create-area">
                {{-- 投稿作成エリア --}}
                {{-- アイコンと入力欄をまとめる場所 --}}

                <div class="post-avatar"></div>
                {{-- 投稿者アイコンを表示する場所 --}}
                {{-- 今は画像ではなく、空の丸アイコンとして表示している --}}

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
                        {{-- bodyにバリデーションエラーがある場合だけ表示する --}}

                        <p class="error-message">{{ $message }}</p>
                        {{-- bodyのエラーメッセージを表示する --}}
                        {{-- error-messageクラスでエラー文の見た目を整える --}}

                    @enderror
                    {{-- エラー表示の条件分岐終了 --}}
                </div>
            </div>
        </form>
        {{-- 投稿フォームの終わり --}}
    </div>
    {{-- post-pageの終わり --}}

@endsection
{{-- contentセクションの終わり --}}