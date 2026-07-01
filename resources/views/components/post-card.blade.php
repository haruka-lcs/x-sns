@props([
    'userName' => '田中',
    'accountId' => '@tanaka',
    'time' => '15分前',
    'body' => '',
    'showDelete' => false,
])

<article class="post-card {{ $showDelete ? 'with-delete' : '' }}">
    <div class="post-avatar"></div>

    <div class="post-content">
        <div class="post-meta">
            <span class="post-user-name">{{ $userName }}</span>
            <span class="post-account-id">{{ $accountId }}</span>
            <span class="post-time">{{ $time }}</span>
        </div>

        <p class="post-text">
            {{ $body }}
        </p>
    </div>

    @if ($showDelete)
        <button type="button" class="delete-post-button">🗑</button>
    @endif
</article>