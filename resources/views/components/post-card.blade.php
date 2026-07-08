@props([
    'userName',
    'accountId',
    'time',
    'body',
    'userId' => null,
    'profileImage' => null,
    'canFollow' => false,
    'isFollowing' => false,
])

<article class="home-post-card">
    <div class="home-avatar-area">
        <div class="home-avatar">
            @if ($profileImage)
                <img
                    src="{{ asset('storage/' . $profileImage) }}"
                    class="home-avatar-image"
                    alt="プロフィール画像"
                >
            @endif
        </div>
    </div>

    <div class="home-post-content">
        <div class="home-post-header">
            <span class="home-user-name">
                {{ $userName }}
            </span>

            <span class="home-account-id">
                {{ '@' . $accountId }}
            </span>

            <span class="home-post-time">
                ・{{ $time }}
            </span>
        </div>

        <p class="home-post-body">
            {{ $body }}
        </p>
    </div>

    @if ($canFollow)
        @if ($isFollowing)
            <form action="{{ route('users.unfollow', $userId) }}" method="POST" class="home-follow-form">
                @csrf
                @method('DELETE')

                <button type="submit" class="home-follow-button following">
                    フォローする
                </button>
            </form>
        @else
            <form action="{{ route('users.follow', $userId) }}" method="POST" class="home-follow-form">
                @csrf

                <button type="submit" class="home-follow-button">
                    フォローする
                </button>
            </form>
        @endif
    @endif
</article>