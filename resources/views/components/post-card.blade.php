@props([
    {{-- このコンポーネントに渡されるデータを定義する --}}

    'userName',
    {{-- 投稿者の表示名 --}}
    {{-- 例：ハル、田中など --}}

    'accountId',
    {{-- 投稿者のアカウントID --}}
    {{-- 例：haru、tanakaなど --}}

    'time',
    {{-- 投稿時間 --}}
    {{-- 例：5分前、2026/07/07 など --}}

    'body',
    {{-- 投稿本文 --}}

    'userId' => null,
    {{-- 投稿者のユーザーID --}}
    {{-- 初期値はnull --}}
    {{-- フォロー処理で使う --}}

    'profileImage' => null,
    {{-- プロフィール画像のパス --}}
    {{-- 初期値はnull --}}
    {{-- 画像がない場合は空のアイコンを表示する --}}

    'canFollow' => false,
    {{-- フォローボタンを表示するかどうか --}}
    {{-- 初期値はfalse --}}
    {{-- trueならフォローボタンを表示する --}}

    'isFollowing' => false,
    {{-- ログイン中ユーザーがこの投稿者をフォローしているかどうか --}}
    {{-- 初期値はfalse --}}
    {{-- trueならフォロー済み状態として表示する --}}
])

<article class="home-post-card">
    {{-- 投稿カード全体を囲むタグ --}}
    {{-- home-post-cardクラスで投稿カードの見た目を整える --}}

    <div class="home-avatar-area">
        {{-- プロフィール画像エリア --}}

        @if ($profileImage)
            {{-- プロフィール画像がある場合の処理 --}}

            <img
                src="{{ asset('storage/' . $profileImage) }}"
                {{-- storage内のプロフィール画像を表示する --}}
                {{-- 例：storage/profile_images/xxx.png のような画像パスになる --}}

                class="home-avatar"
                {{-- プロフィール画像にCSSを当てる --}}

                alt="プロフィール画像"
                {{-- 画像が表示されない場合や読み上げ用の説明文 --}}
            >
        @else
            {{-- プロフィール画像がない場合の処理 --}}

            <div class="home-avatar"></div>
            {{-- 空の丸アイコンを表示する --}}
        @endif
        {{-- プロフィール画像の条件分岐終了 --}}
    </div>

    <div class="home-post-content">
        {{-- 投稿内容エリア --}}
        {{-- ユーザー名、ID、時間、本文をまとめる場所 --}}

        <div class="home-post-header">
            {{-- 投稿の上部分 --}}
            {{-- ユーザー名、アカウントID、投稿時間を並べる場所 --}}

            <span class="home-user-name">
                {{-- 投稿者名を表示する場所 --}}

                {{ $userName }}
                {{-- 投稿者の表示名を表示する --}}
            </span>

            <span class="home-account-id">
                {{-- アカウントIDを表示する場所 --}}

                {{ '@' . $accountId }}
                {{-- accountIdの前に@を付けて表示する --}}
                {{-- 例：@haru --}}
            </span>

            <span class="home-post-time">
                {{-- 投稿時間を表示する場所 --}}

                ・{{ $time }}
                {{-- 先頭に「・」を付けて投稿時間を表示する --}}
            </span>
        </div>

        <p class="home-post-body">
            {{-- 投稿本文を表示する場所 --}}

            {{ $body }}
            {{-- 投稿本文を表示する --}}
        </p>
    </div>

    @if ($canFollow)
        {{-- canFollowがtrueならフォローボタンを表示する --}}
        {{-- falseならフォローボタンは表示しない --}}

        @if ($isFollowing)
            {{-- すでにフォローしている場合の表示 --}}

            <form action="{{ route('users.unfollow', $userId) }}" method="POST" class="home-follow-form">
                {{-- フォロー解除用のフォーム --}}
                {{-- users.unfollowルートに送信する --}}
                {{-- $userIdにはフォロー解除したいユーザーのIDが入る --}}
                {{-- 見た目にはPOSTだが、下の@method('DELETE')でDELETE扱いにする --}}

                @csrf
                {{-- CSRF対策用のトークンを入れる --}}
                {{-- LaravelでPOST/DELETE送信するときに必要 --}}

                @method('DELETE')
                {{-- このフォーム送信をDELETEリクエストとして扱う --}}
                {{-- フォロー解除処理に使う --}}

                <button type="submit" class="home-follow-button following">
                    {{-- フォロー済み状態のボタン --}}
                    {{-- followingクラスでフォロー中の見た目にする --}}

                    フォローする
                    {{-- ボタンに表示する文字 --}}
                    {{-- 今はフォロー済みでも「フォローする」と表示される --}}
                </button>
            </form>
        @else
            {{-- まだフォローしていない場合の表示 --}}

            <form action="{{ route('users.follow', $userId) }}" method="POST" class="home-follow-form">
                {{-- フォロー用のフォーム --}}
                {{-- users.followルートにPOST送信する --}}
                {{-- $userIdにはフォローしたいユーザーのIDが入る --}}

                @csrf
                {{-- CSRF対策用のトークンを入れる --}}
                {{-- LaravelでPOST送信するときに必要 --}}

                <button type="submit" class="home-follow-button">
                    {{-- フォローするボタン --}}
                    {{-- home-follow-buttonクラスで見た目を整える --}}

                    フォローする
                    {{-- ボタンに表示する文字 --}}
                </button>
            </form>
        @endif
        {{-- フォロー済みかどうかの条件分岐終了 --}}
    @endif
    {{-- フォローボタンを表示するかどうかの条件分岐終了 --}}
</article>
{{-- 投稿カード全体の終わり --}}