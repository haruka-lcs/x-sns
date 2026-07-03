@props([
    'userName',
    'accountId',
    'time',
    'body',
    'postId' => null,
    'canDelete' => false,
    'userId' => null,
    'canFollow' => false,
    'isFollowing' => false,
])

<article class="post-card {{ $canDelete ? 'with-delete' : '' }}">
    <div class="post-avatar"></div>

    <div class="post-content">
        <div class="post-meta">
            <span class="post-user-name">{{ $userName }}</span>
            <span class="post-account-id">{{ $accountId }}</span>
            <span class="post-time">{{ $time }}</span>

            @if ($canFollow && $userId)
                @if ($isFollowing)
                    <form action="{{ route('users.unfollow', $userId) }}" method="POST" class="follow-form">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="follow-button following">
                            フォロー中
                        </button>
                    </form>
                @else
                    <form action="{{ route('users.follow', $userId) }}" method="POST" class="follow-form">
                        @csrf

                        <button type="submit" class="follow-button">
                            フォロー
                        </button>
                    </form>
                @endif
            @endif
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