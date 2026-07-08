{{-- このコンポーネントに外から渡される値を定義する。activeが渡されなかった場合はhomeにする --}}
@props(['active' => 'home'])

{{-- 画面下に表示するナビゲーション全体を作る --}}
<nav class="bottom-nav">

    {{-- ホーム画面へ移動するリンクを作る --}}
    <a href="/home" class="bottom-nav-item {{ $active === 'home' ? 'active' : '' }}">

        {{-- ホーム用のアイコンを表示する --}}
        <span class="nav-icon">⌂</span>

        {{-- ホームという文字を表示する --}}
        <span>ホーム</span>

    {{-- ホームへのリンクを閉じる --}}
    </a>

    {{-- 投稿画面へ移動するリンクを作る --}}
    <a href="/post" class="bottom-nav-item {{ $active === 'post' ? 'active' : '' }}">

        {{-- 投稿用のアイコンを表示する --}}
        <span class="nav-icon">＋</span>

        {{-- 投稿という文字を表示する --}}
        <span>投稿</span>

    {{-- 投稿へのリンクを閉じる --}}
    </a>

    {{-- プロフィール画面へ移動するリンクを作る --}}
    <a href="/profile" class="bottom-nav-item {{ $active === 'profile' ? 'active' : '' }}">

        {{-- プロフィール用のアイコンを表示する --}}
        <span class="nav-icon">♙</span>

        {{-- プロフィールという文字を表示する --}}
        <span>プロフィール</span>

    {{-- プロフィールへのリンクを閉じる --}}
    </a>

{{-- 下部ナビゲーション全体を閉じる --}}
</nav>