@props(['active' => 'home'])

<nav class="bottom-nav">
    <a href="/home" class="bottom-nav-item {{ $active === 'home' ? 'active' : '' }}">
        <span class="nav-icon">⌂</span>
        <span>ホーム</span>
    </a>

    <a href="/post" class="bottom-nav-item {{ $active === 'post' ? 'active' : '' }}">
        <span class="nav-icon">＋</span>
        <span>投稿</span>
    </a>

    <a href="/profile" class="bottom-nav-item {{ $active === 'profile' ? 'active' : '' }}">
        <span class="nav-icon">♙</span>
        <span>プロフィール</span>
    </a>
</nav>