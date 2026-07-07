@extends('layouts.app')
{{-- layouts/app.blade.php を土台として使う --}}

@section('title', 'ログイン')
{{-- ページタイトルに「ログイン」を入れる --}}
{{-- layouts.app の @yield('title') に入る --}}

@section('css')
{{-- このページ専用のCSSを書く場所 --}}

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    {{-- public/css/login.css を読み込む --}}
    {{-- ログイン画面専用のCSSを適用する --}}

@endsection
{{-- cssセクションの終わり --}}

@section('content')
{{-- 画面に表示する中身を書く場所 --}}
{{-- layouts.app の @yield('content') に入る --}}

    <div class="login-page">
        {{-- ログイン画面全体を囲む --}}
        {{-- login-pageクラスで画面全体の見た目を整える --}}

        <header class="login-header">
            {{-- ログイン画面のヘッダー部分 --}}

            <h1>ログイン</h1>
            {{-- 画面上部に「ログイン」と表示する --}}
        </header>

        <main class="login-main">
            {{-- ログイン画面のメイン部分 --}}
            {{-- フォームを入れる場所 --}}

            <form action="/login" method="POST" class="login-form">
                {{-- ログインフォーム --}}
                {{-- action="/login" なので /login に送信する --}}
                {{-- method="POST" なのでPOST送信する --}}
                {{-- login-formクラスでフォームの見た目を整える --}}

                @csrf
                {{-- CSRF対策用のトークンを入れる --}}
                {{-- LaravelでPOST送信するときに必要 --}}

                <div class="login-form-row">
                    {{-- ユーザーIDのラベルと入力欄をまとめる行 --}}

                    <label for="account_id" class="login-label">
                        {{-- account_id入力欄のラベル --}}
                        {{-- for="account_id" で下のinputとつながる --}}

                        ユーザーID
                        {{-- ラベルに表示する文字 --}}
                    </label>

                    <input
                        {{-- 1行入力用のフォーム部品 --}}

                        type="text"
                        {{-- テキスト入力欄にする --}}

                        id="account_id"
                        {{-- この入力欄のidをaccount_idにする --}}
                        {{-- labelのforと対応している --}}

                        name="account_id"
                        {{-- 入力された値をaccount_idという名前で送信する --}}
                        {{-- AuthControllerの $request->account_id で受け取れる --}}

                        class="login-input"
                        {{-- 入力欄にCSSを当てる --}}

                        value="{{ old('account_id') }}"
                        {{-- 前回入力したユーザーIDを残す --}}
                        {{-- ログイン失敗で戻ってきたときに入力内容が消えないようにする --}}
                    >
                </div>

                <div class="login-form-row">
                    {{-- パスワードのラベルと入力欄をまとめる行 --}}

                    <label for="password" class="login-label">
                        {{-- password入力欄のラベル --}}
                        {{-- for="password" で下のinputとつながる --}}

                        パスワード
                        {{-- ラベルに表示する文字 --}}
                    </label>

                    <input
                        {{-- 1行入力用のフォーム部品 --}}

                        type="password"
                        {{-- パスワード入力欄にする --}}
                        {{-- 入力した文字が見えないようになる --}}

                        id="password"
                        {{-- この入力欄のidをpasswordにする --}}
                        {{-- labelのforと対応している --}}

                        name="password"
                        {{-- 入力された値をpasswordという名前で送信する --}}
                        {{-- AuthControllerの $request->password で受け取れる --}}

                        class="login-input"
                        {{-- 入力欄にCSSを当てる --}}
                    >
                </div>

                @if ($errors->any())
                    {{-- バリデーションエラーやログインエラーが1つでもある場合だけ表示する --}}

                    <p class="login-error-message">
                        {{-- エラーメッセージを表示する段落 --}}
                        {{-- login-error-messageクラスで見た目を整える --}}

                        ユーザーIDまたはパスワードが正しくありません。
                        {{-- ログイン失敗時に表示するメッセージ --}}
                    </p>
                @endif
                {{-- エラー表示の条件分岐終了 --}}

                <div class="login-button-area">
                    {{-- 完了ボタンと戻るリンクをまとめるエリア --}}

                    <button type="submit" class="login-submit-button">
                        {{-- フォーム送信用のボタン --}}
                        {{-- type="submit" なので押すとフォームが送信される --}}
                        {{-- login-submit-buttonクラスで見た目を整える --}}

                        完了
                        {{-- ボタンに表示する文字 --}}
                    </button>

                    <a href="/" class="login-back-link">
                        {{-- トップ画面へ戻るリンク --}}
                        {{-- href="/" なのでトップ画面に移動する --}}
                        {{-- login-back-linkクラスで見た目を整える --}}

                        戻る
                        {{-- リンクに表示する文字 --}}
                    </a>
                </div>
            </form>
            {{-- ログインフォームの終わり --}}
        </main>
    </div>
    {{-- login-pageの終わり --}}

@endsection
{{-- contentセクションの終わり --}}