{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「ログイン」に設定する --}}
@section('title', 'ログイン')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/login.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- ログインページ全体を囲むエリア --}}
    <div class="login-page">

        {{-- ログインページのヘッダー部分 --}}
        <header class="login-header">

            {{-- ページタイトルとして「ログイン」を表示する --}}
            <h1>ログイン</h1>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- ログインページのメイン部分 --}}
        <main class="login-main">

            {{-- ログイン情報を送信するためのフォーム --}}
            <form action="/login" method="POST" class="login-form">

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- ユーザーID入力欄の行を作る --}}
                <div class="login-form-row">

                    {{-- ユーザーID入力欄のラベルを作る --}}
                    <label for="account_id" class="login-label">

                        {{-- ラベルに表示する文字 --}}
                        ユーザーID

                    {{-- ラベルを閉じる --}}
                    </label>

                    {{-- ユーザーIDを入力する欄 --}}
                    <input

                        {{-- テキスト入力欄にする --}}
                        type="text"

                        {{-- ラベルと紐づけるためのIDを設定する --}}
                        id="account_id"

                        {{-- フォーム送信時の名前をaccount_idにする --}}
                        name="account_id"

                        {{-- ユーザーID入力欄用のCSSを当てる --}}
                        class="login-input"

                        {{-- 入力エラーなどで戻ってきた時に、前回入力したユーザーIDを表示する --}}
                        value="{{ old('account_id') }}"

                    {{-- inputタグを閉じる --}}
                    >

                {{-- ユーザーID入力欄の行を閉じる --}}
                </div>

                {{-- パスワード入力欄の行を作る --}}
                <div class="login-form-row">

                    {{-- パスワード入力欄のラベルを作る --}}
                    <label for="password" class="login-label">

                        {{-- ラベルに表示する文字 --}}
                        パスワード

                    {{-- ラベルを閉じる --}}
                    </label>

                    {{-- パスワードを入力する欄 --}}
                    <input

                        {{-- 入力した文字が見えないパスワード入力欄にする --}}
                        type="password"

                        {{-- ラベルと紐づけるためのIDを設定する --}}
                        id="password"

                        {{-- フォーム送信時の名前をpasswordにする --}}
                        name="password"

                        {{-- パスワード入力欄用のCSSを当てる --}}
                        class="login-input"

                    {{-- inputタグを閉じる --}}
                    >

                {{-- パスワード入力欄の行を閉じる --}}
                </div>

                {{-- バリデーションエラーが1つでもある場合だけ表示する --}}
                @if ($errors->any())

                    {{-- ログイン失敗時のエラーメッセージを表示する --}}
                    <p class="login-error-message">

                        {{-- エラーとして表示する文字 --}}
                        ユーザーIDまたはパスワードが正しくありません。

                    {{-- エラーメッセージを閉じる --}}
                    </p>

                {{-- エラーがある場合の条件分岐を終了する --}}
                @endif

                {{-- ログインボタンと戻るリンクをまとめるエリア --}}
                <div class="login-button-area">

                    {{-- フォームを送信するボタン --}}
                    <button type="submit" class="login-submit-button">

                        {{-- ボタンに表示する文字 --}}
                        完了

                    {{-- 送信ボタンを閉じる --}}
                    </button>

                    {{-- トップページへ戻るリンク --}}
                    <a href="/" class="login-back-link">

                        {{-- リンクに表示する文字 --}}
                        戻る

                    {{-- 戻るリンクを閉じる --}}
                    </a>

                {{-- ボタンエリアを閉じる --}}
                </div>

            {{-- ログインフォームを閉じる --}}
            </form>

        {{-- メイン部分を閉じる --}}
        </main>

    {{-- ログインページ全体を閉じる --}}
    </div>

{{-- contentセクションを終了する --}}
@endsection