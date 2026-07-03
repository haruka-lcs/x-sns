@props([
    'userName',
    'accountId',
    'time',
    'body',
    'postId' => null,
    'canDelete' => false,
])

<article class="post-card {{ $canDelete ? 'with-delete' : '' }}">
    <div class="post-avatar"></div>

    <div class="post-content">
        <div class="post-meta">
            <span class="post-user-name">{{ $userName }}</span>
            <span class="post-account-id">{{ $accountId }}</span>
            <span class="post-time">{{ $time }}</span>
        </div>

        <p class="post-text">{{ $body }}</p>
    </div>

    @if ($canDelete && $postId)
        <form action="{{ route('posts.destroy', $postId) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-post-button">
                ×
            </button>
        </form>
    @endif
</article>