{{-- 共通レイアウトファイル layouts.app を使う --}}
@extends('layouts.app')

{{-- このページのタイトルを「トップ」に設定する --}}
@section('title', 'トップ')

{{-- このページ専用のCSSを読み込む --}}
@section('css')

    {{-- public/css/top.css を読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">

{{-- cssセクションを終了する --}}
@endsection

{{-- ページの中身をここから書く --}}
@section('content')

    {{-- トップページ全体を囲むエリア --}}
    <div class="top-page">

        {{-- ログインボタンと新規登録ボタンをまとめるエリア --}}
        <div class="top-button-area">

            {{-- ログイン画面へ移動するリンク --}}
            <a href="/login" class="top-button top-login-button">

                {{-- ログインボタンに表示する文字 --}}
                ログイン

            {{-- ログインリンクを閉じる --}}
            </a>

            {{-- 新規登録画面へ移動するリンク --}}
            <a href="/register" class="top-button top-register-button">

                {{-- 新規登録ボタンに表示する文字 --}}
                新規登録

            {{-- 新規登録リンクを閉じる --}}
            </a>

        {{-- ボタンエリアを閉じる --}}
        </div>

    {{-- トップページ全体を閉じる --}}
    </div>

{{-- contentセクションを終了する --}}
@endsection