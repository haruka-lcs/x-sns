{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「プロフィール編集」に設定する --}}
@section('title', 'プロフィール編集')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/profile-edit.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- プロフィール編集ページ全体を囲むエリア --}}
    <div class="profile-edit-page">

        {{-- プロフィール編集ページのヘッダー部分 --}}
        <header class="profile-edit-header">

            {{-- ページタイトルとして「プロフィール」を表示する --}}
            <h1>プロフィール</h1>

        {{-- ヘッダーを閉じる --}}
        </header>

        {{-- プロフィール編集ページのメイン部分 --}}
        <main class="profile-edit-main">

            {{-- プロフィール情報を送信するためのフォーム --}}
            <form

                {{-- フォームの送信先をプロフィール編集処理にする --}}
                action="/profile/edit"

                {{-- POSTメソッドで送信する --}}
                method="POST"

                {{-- プロフィール編集フォーム用のCSSを当てる --}}
                class="profile-edit-form"

                {{-- 画像ファイルを送信できるようにする --}}
                enctype="multipart/form-data"
            >

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- プロフィール画像をクリックして画像選択できるようにするラベル --}}
                <label for="profile_image" class="profile-edit-avatar">

                    {{-- 現在のプロフィール画像、または選択後のプレビュー画像を表示する --}}
                    <img

                        {{-- JavaScriptで画像プレビューを操作するためのID --}}
                        id="avatarPreview"

                        {{-- プロフィール画像がある場合はstorage内の画像URLを表示し、ない場合は空にする --}}
                        src="{{ $loginUser->profile_image ? asset('storage/' . $loginUser->profile_image) : '' }}"

                        {{-- 画像が表示されない時や読み上げ用の説明を設定する --}}
                        alt="プロフィール画像"

                        {{-- 画像がある場合は表示し、画像がない場合はhiddenクラスを付けて非表示にする --}}
                        class="profile-edit-avatar-image {{ $loginUser->profile_image ? '' : 'hidden' }}"
                    >

                {{-- プロフィール画像選択用のラベルを閉じる --}}
                </label>

                {{-- プロフィール画像を選択するためのファイル入力欄 --}}
                <input

                    {{-- ファイルを選択する入力欄にする --}}
                    type="file"

                    {{-- ラベルとJavaScriptで紐づけるためのIDを設定する --}}
                    id="profile_image"

                    {{-- フォーム送信時の名前をprofile_imageにする --}}
                    name="profile_image"

                    {{-- 画像ファイルだけ選択できるようにする --}}
                    accept="image/*"

                    {{-- ファイル入力欄用のCSSを当てる --}}
                    class="profile-edit-file-input"
                >

                {{-- profile_imageにバリデーションエラーがある場合だけ表示する --}}
                @error('profile_image')

                    {{-- プロフィール画像のエラーメッセージを表示する --}}
                    <p class="profile-edit-error-message">{{ $message }}</p>

                {{-- エラー表示の処理を終了する --}}
                @enderror

                {{-- 入力フォーム全体を囲むエリア --}}
                <div class="profile-edit-form-area">

                    {{-- ユーザーID入力欄の行を作る --}}
                    <div class="profile-edit-form-row">

                        {{-- ユーザーID入力欄のラベルを作る --}}
                        <label for="account_id" class="profile-edit-label">

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
                            class="profile-edit-input"

                            {{-- エラー時は前回入力した値を表示し、通常時は現在のユーザーIDを表示する --}}
                            value="{{ old('account_id', $loginUser->account_id) }}"
                        >

                    {{-- ユーザーID入力欄の行を閉じる --}}
                    </div>

                    {{-- account_idにバリデーションエラーがある場合だけ表示する --}}
                    @error('account_id')

                        {{-- ユーザーIDのエラーメッセージを表示する --}}
                        <p class="profile-edit-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                    {{-- ユーザーネーム入力欄の行を作る --}}
                    <div class="profile-edit-form-row">

                        {{-- ユーザーネーム入力欄のラベルを作る --}}
                        <label for="user_name" class="profile-edit-label">

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
                            class="profile-edit-input"

                            {{-- エラー時は前回入力した値を表示し、通常時は現在のユーザーネームを表示する --}}
                            value="{{ old('user_name', $loginUser->user_name) }}"
                        >

                    {{-- ユーザーネーム入力欄の行を閉じる --}}
                    </div>

                    {{-- user_nameにバリデーションエラーがある場合だけ表示する --}}
                    @error('user_name')

                        {{-- ユーザーネームのエラーメッセージを表示する --}}
                        <p class="profile-edit-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                    {{-- パスワード入力欄の行を作る --}}
                    <div class="profile-edit-form-row">

                        {{-- パスワード入力欄のラベルを作る --}}
                        <label for="password" class="profile-edit-label">

                            {{-- ラベルに表示する文字 --}}
                            パスワード

                        {{-- ラベルを閉じる --}}
                        </label>

                        {{-- パスワードを入力する欄 --}}
                        <input

                            {{-- テキスト入力欄にする --}}
                            type="text"

                            {{-- ラベルと紐づけるためのIDを設定する --}}
                            id="password"

                            {{-- フォーム送信時の名前をpasswordにする --}}
                            name="password"

                            {{-- 入力欄用のCSSを当てる --}}
                            class="profile-edit-input"

                            {{-- エラー時に前回入力したパスワードを表示する --}}
                            value="{{ old('password') }}"
                        >

                    {{-- パスワード入力欄の行を閉じる --}}
                    </div>

                    {{-- passwordにバリデーションエラーがある場合だけ表示する --}}
                    @error('password')

                        {{-- パスワードのエラーメッセージを表示する --}}
                        <p class="profile-edit-error-message">{{ $message }}</p>

                    {{-- エラー表示の処理を終了する --}}
                    @enderror

                {{-- 入力フォーム全体のエリアを閉じる --}}
                </div>

                {{-- 保存ボタンを囲むエリア --}}
                <div class="profile-edit-button-area">

                    {{-- フォームを送信する保存ボタン --}}
                    <button type="submit" class="profile-edit-submit-button">

                        {{-- ボタンに表示する文字 --}}
                        保存する

                    {{-- 保存ボタンを閉じる --}}
                    </button>

                {{-- 保存ボタンエリアを閉じる --}}
                </div>

            {{-- プロフィール編集フォームを閉じる --}}
            </form>

        {{-- メイン部分を閉じる --}}
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

    {{-- プロフィール編集ページ全体を閉じる --}}
    </div>

    {{-- 画像を選択した時に、画面上でプレビュー表示するためのJavaScript --}}
    <script>

        // profile_imageというIDを持つファイル入力欄を取得する
        const profileImageInput = document.getElementById('profile_image');

        // avatarPreviewというIDを持つ画像タグを取得する
        const avatarPreview = document.getElementById('avatarPreview');

        // ファイル入力欄の中身が変わった時に処理を実行する
        profileImageInput.addEventListener('change', function () {

            // 選択されたファイルの1つ目を取得する
            const file = this.files[0];

            // ファイルが選択されていなければ、ここで処理を止める
            if (file === undefined) {

                // これ以降の処理を実行しない
                return;
            }

            // 選択した画像ファイルを一時的に表示できるURLに変換する
            const imageUrl = URL.createObjectURL(file);

            // プレビュー画像の表示先を、選択した画像のURLに変更する
            avatarPreview.src = imageUrl;

            // hiddenクラスを外して、プレビュー画像を表示する
            avatarPreview.classList.remove('hidden');

        // changeイベントの処理を終了する
        });

    {{-- JavaScriptを終了する --}}
    </script>

{{-- contentセクションを終了する --}}
@endsection