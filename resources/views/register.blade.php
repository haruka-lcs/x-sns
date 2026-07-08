{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「新規登録」に設定する --}}
@section('title', '新規登録')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/register.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- 新規登録ページ全体を囲むエリア --}}
    <div class="register-page">

        {{-- 新規登録ページのヘッダー部分 --}}
        <header class="register-header">

            {{-- ページタイトルとして「新規登録」を表示する --}}
            <h1>新規登録</h1>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- 新規登録ページのメイン部分 --}}
        <main class="register-main">

            {{-- 新規登録情報を送信するためのフォーム --}}
            <form action="/register" method="POST" class="register-form" enctype="multipart/form-data">

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- プロフィール画像をクリックして画像選択できるようにするエリア --}}
                <label class="register-avatar-upload">

                    {{-- 選択したプロフィール画像のプレビューを表示する枠 --}}
                    <div id="register-avatar-preview" class="register-avatar"></div>

                    {{-- プロフィール画像を選択するためのファイル入力欄 --}}
                    <input

                        {{-- ファイルを選択する入力欄にする --}}
                        type="file"

                        {{-- フォーム送信時の名前をprofile_imageにする --}}
                        name="profile_image"

                        {{-- JavaScriptで操作するためのIDを設定する --}}
                        id="register-profile-image"

                        {{-- ファイル入力欄用のCSSを当てる --}}
                        class="register-file-input"

                        {{-- 画像ファイルだけ選択できるようにする --}}
                        accept="image/*"
                    >

                {{-- プロフィール画像アップロードエリアを閉じる --}}
                </label>

                {{-- profile_imageにバリデーションエラーがある場合だけ表示する --}}
                @error('profile_image')

                    {{-- プロフィール画像のエラーメッセージを表示する --}}
                    <p class="register-image-error-message">{{ $message }}</p>

                {{-- エラー表示の処理を終了する --}}
                @enderror

                {{-- 入力フォーム全体を囲むエリア --}}
                <div class="register-form-area">

                    {{-- ユーザーID入力欄の行を作る --}}
                    <div class="register-form-row">

                        {{-- ユーザーID入力欄のラベルを作る --}}
                        <label for="account_id" class="register-label">

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

                            {{-- 入力欄用のCSSを当てる --}}
                            class="register-input"

                            {{-- エラー時に前回入力したユーザーIDを表示する --}}
                            value="{{ old('account_id') }}"
                        >

                    {{-- ユーザーID入力欄の行を閉じる --}}
                    </div>

                    {{-- account_idにバリデーションエラーがある場合だけ表示する --}}
                    @error('account_id')

                        {{-- ユーザーIDのエラーメッセージを表示する --}}
                        <p class="register-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                    {{-- ユーザーネーム入力欄の行を作る --}}
                    <div class="register-form-row">

                        {{-- ユーザーネーム入力欄のラベルを作る --}}
                        <label for="user_name" class="register-label">

                            {{-- ラベルに表示する文字 --}}
                            ユーザーネーム

                        {{-- ラベルを閉じる --}}
                        </label>

                        {{-- ユーザーネームを入力する欄 --}}
                        <input

                            {{-- テキスト入力欄にする --}}
                            type="text"

                            {{-- ラベルと紐づけるためのIDを設定する --}}
                            id="user_name"

                            {{-- フォーム送信時の名前をuser_nameにする --}}
                            name="user_name"

                            {{-- 入力欄用のCSSを当てる --}}
                            class="register-input"

                            {{-- エラー時に前回入力したユーザーネームを表示する --}}
                            value="{{ old('user_name') }}"
                        >

                    {{-- ユーザーネーム入力欄の行を閉じる --}}
                    </div>

                    {{-- user_nameにバリデーションエラーがある場合だけ表示する --}}
                    @error('user_name')

                        {{-- ユーザーネームのエラーメッセージを表示する --}}
                        <p class="register-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                    {{-- パスワード入力欄の行を作る --}}
                    <div class="register-form-row">

                        {{-- パスワード入力欄のラベルを作る --}}
                        <label for="password" class="register-label">

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

                            {{-- 入力欄用のCSSを当てる --}}
                            class="register-input"
                        >

                    {{-- パスワード入力欄の行を閉じる --}}
                    </div>

                    {{-- passwordにバリデーションエラーがある場合だけ表示する --}}
                    @error('password')

                        {{-- パスワードのエラーメッセージを表示する --}}
                        <p class="register-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                {{-- 入力フォーム全体のエリアを閉じる --}}
                </div>

                {{-- 完了ボタンと戻るリンクをまとめるエリア --}}
                <div class="register-button-area">

                    {{-- 新規登録フォームを送信するボタン --}}
                    <button type="submit" class="register-submit-button">

                        {{-- ボタンに表示する文字 --}}
                        完了

                    {{-- 送信ボタンを閉じる --}}
                    </button>

                    {{-- トップページへ戻るリンク --}}
                    <a href="/" class="register-back-link">

                        {{-- リンクに表示する文字 --}}
                        戻る

                    {{-- 戻るリンクを閉じる --}}
                    </a>

                {{-- ボタンエリアを閉じる --}}
                </div>

            {{-- 新規登録フォームを閉じる --}}
            </form>

        {{-- メイン部分を閉じる --}}
        </main>

    {{-- 新規登録ページ全体を閉じる --}}
    </div>

    {{-- 画像を選択した時に、画面上でプレビュー表示するためのJavaScript --}}
    <script>

        // register-profile-imageというIDを持つファイル入力欄を取得する
        const registerProfileImage = document.getElementById('register-profile-image');

        // register-avatar-previewというIDを持つ画像プレビュー用の要素を取得する
        const registerAvatarPreview = document.getElementById('register-avatar-preview');

        // ファイル入力欄の中身が変わった時に処理を実行する
        registerProfileImage.addEventListener('change', function () {

            // 選択されたファイルの1つ目を取得する
            const file = this.files[0];

            // ファイルが選択されていなければ、ここで処理を止める
            if (!file) {

                // これ以降の処理を実行しない
                return;
            }

            // 選択した画像ファイルを一時的に表示できるURLに変換する
            const imageUrl = URL.createObjectURL(file);

            // プレビュー枠の背景画像を、選択した画像に変更する
            registerAvatarPreview.style.backgroundImage = `url(${imageUrl})`;

            // has-imageクラスを追加して、画像あり用の見た目にする
            registerAvatarPreview.classList.add('has-image');

        // changeイベントの処理を終了する
        });

    {{-- JavaScriptを終了する --}}
    </script>

{{-- contentセクションを終了する --}}
@endsection