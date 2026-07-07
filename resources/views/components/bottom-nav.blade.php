@props(['active' => 'home'])
{{-- このコンポーネントに渡される値を定義している --}}
{{-- activeという値を受け取る --}}
{{-- 何も指定されなかった場合は、初期値としてhomeを使う --}}

<nav class="bottom-nav">
    {{-- 下部ナビゲーション全体を囲むタグ --}}
    {{-- bottom-navクラスでCSSを当てる --}}

    <a href="/home" class="bottom-nav-item {{ $active === 'home' ? 'active' : '' }}">
        {{-- ホーム画面へ移動するリンク --}}
        {{-- bottom-nav-itemクラスでナビ項目の見た目を整える --}}
        {{-- $activeがhomeならactiveクラスを追加する --}}
        {{-- $activeがhomeじゃなければ何も追加しない --}}

        <span class="nav-icon">⌂</span>
        {{-- ホーム用のアイコンを表示する --}}
        {{-- nav-iconクラスでアイコンの見た目を整える --}}

        <span>ホーム</span>
        {{-- ホームという文字を表示する --}}
    </a>

    <a href="/post" class="bottom-nav-item {{ $active === 'post' ? 'active' : '' }}">
        {{-- 投稿画面へ移動するリンク --}}
        {{-- $activeがpostならactiveクラスを追加する --}}
        {{-- 今いるページが投稿画面なら、このメニューが選択中の見た目になる --}}

        <span class="nav-icon">＋</span>
        {{-- 投稿用のアイコンを表示する --}}

        <span>投稿</span>
        {{-- 投稿という文字を表示する --}}
    </a>

    <a href="/profile" class="bottom-nav-item {{ $active === 'profile' ? 'active' : '' }}">
        {{-- プロフィール画面へ移動するリンク --}}
        {{-- $activeがprofileならactiveクラスを追加する --}}
        {{-- 今いるページがプロフィール画面なら、このメニューが選択中の見た目になる --}}

        <span class="nav-icon">♙</span>
        {{-- プロフィール用のアイコンを表示する --}}

        <span>プロフィール</span>
        {{-- プロフィールという文字を表示する --}}
    </a>
</nav>
{{-- 下部ナビゲーションの終わり --}}