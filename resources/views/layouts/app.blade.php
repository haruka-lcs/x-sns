<!DOCTYPE html>
{{-- このHTMLがHTML5で書かれていることをブラウザに伝える --}}

<html lang="ja">
{{-- HTML全体の開始 --}}
{{-- lang="ja" は、このページの言語が日本語という意味 --}}

<head>
    {{-- ページの設定情報を書く場所 --}}
    {{-- 画面には直接表示されない --}}

    <meta charset="UTF-8">
    {{-- 文字コードをUTF-8に設定する --}}
    {{-- 日本語の文字化けを防ぐために必要 --}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- スマホ表示に対応するための設定 --}}
    {{-- 画面幅に合わせて表示する --}}
    {{-- initial-scale=1.0 は初期表示倍率を1倍にするという意味 --}}

    <title>@yield('title')</title>
    {{-- ブラウザのタブに表示されるタイトル --}}
    {{-- 各ページ側で @section('title', 'ホーム') みたいに指定した内容が入る --}}

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    {{-- public/css/common.css を読み込む --}}
    {{-- 全ページ共通のCSSを適用する --}}

    @yield('css')
    {{-- 各ページ専用のCSSを差し込む場所 --}}
    {{-- 例：home.css、profile.css など --}}
</head>

<body>
    {{-- 画面に表示される内容を書く場所 --}}

    @yield('content')
    {{-- 各ページのメイン内容を差し込む場所 --}}
    {{-- 各Bladeファイルの @section('content') の中身がここに入る --}}
</body>
{{-- bodyの終わり --}}

</html>
{{-- HTML全体の終わり --}}