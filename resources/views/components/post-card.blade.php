{{-- このコンポーネントに外から渡される値を定義する --}}
@props([

    {{-- 投稿者の表示名を受け取る --}}
    'userName',

    {{-- 投稿者のアカウントIDを受け取る --}}
    'accountId',

    {{-- 投稿時間を受け取る --}}
    'time',

    {{-- 投稿本文を受け取る --}}
    'body',

    {{-- 投稿者のユーザーIDを受け取る。初期値はnull --}}
    'userId' => null,

    {{-- プロフィール画像のパスを受け取る。初期値はnull --}}
    'profileImage' => null,

    {{-- フォローボタンを表示するかどうかを受け取る。初期値はfalse --}}
    'canFollow' => false,

    {{-- ログイン中のユーザーがこの投稿者をフォローしているかどうかを受け取る。初期値はfalse --}}
    'isFollowing' => false,

{{-- propsの定義を終了する --}}
])

{{-- 投稿1件分のカード全体を作る --}}
<article class="home-post-card">

    {{-- プロフィール画像を表示するエリアを作る --}}
    <div class="home-avatar-area">

        {{-- プロフィール画像を入れる丸い枠を作る --}}
        <div class="home-avatar">

            {{-- プロフィール画像が登録されている場合だけ画像を表示する --}}
            @if ($profileImage)

                {{-- プロフィール画像を表示する --}}
                <img

                    {{-- storageフォルダに保存されている画像のURLを作る --}}
                    src="{{ asset('storage/' . $profileImage) }}"

                    {{-- プロフィール画像用のCSSを当てる --}}
                    class="home-avatar-image"

                    {{-- 画像が表示されない時や読み上げ用の説明を設定する --}}
                    alt="プロフィール画像"

                {{-- imgタグを閉じる --}}
                >

            {{-- プロフィール画像がある場合だけ表示する処理を終了する --}}
            @endif

        {{-- プロフィール画像の枠を閉じる --}}
        </div>

    {{-- プロフィール画像エリアを閉じる --}}
    </div>

    {{-- 投稿内容を表示するエリアを作る --}}
    <div class="home-post-content">

        {{-- 投稿者名・アカウントID・投稿時間を表示するエリアを作る --}}
        <div class="home-post-header">

            {{-- 投稿者の表示名を表示するためのタグを作る --}}
            <span class="home-user-name">

                {{-- 投稿者の表示名を表示する --}}
                {{ $userName }}

            {{-- 投稿者名のタグを閉じる --}}
            </span>

            {{-- 投稿者のアカウントIDを表示するためのタグを作る --}}
            <span class="home-account-id">

                {{-- アカウントIDの前に@を付けて表示する --}}
                {{ '@' . $accountId }}

            {{-- アカウントIDのタグを閉じる --}}
            </span>

            {{-- 投稿時間を表示するためのタグを作る --}}
            <span class="home-post-time">

                {{-- 投稿時間の前に「・」を付けて表示する --}}
                ・{{ $time }}

            {{-- 投稿時間のタグを閉じる --}}
            </span>

        {{-- 投稿ヘッダーを閉じる --}}
        </div>

        {{-- 投稿本文を表示するための段落を作る --}}
        <p class="home-post-body">

            {{-- 投稿本文を表示する --}}
            {{ $body }}

        {{-- 投稿本文の段落を閉じる --}}
        </p>

    {{-- 投稿内容エリアを閉じる --}}
    </div>

    {{-- フォローボタンを表示していい場合だけ、この中の処理を実行する --}}
    @if ($canFollow)

        {{-- すでにフォローしているユーザーかどうかを判定する --}}
        @if ($isFollowing)

            {{-- フォロー解除用のフォームを作る --}}
            <form action="{{ route('users.unfollow', $userId) }}" method="POST" class="home-follow-form">

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- HTMLフォームではDELETEが直接使えないため、LaravelにDELETEリクエストとして扱わせる --}}
                @method('DELETE')

                {{-- フォロー中の状態を表すボタンを作る --}}
                <button type="submit" class="home-follow-button following">

                    {{-- ボタンに表示する文字 --}}
                    フォロー中

                {{-- ボタンを閉じる --}}
                </button>

            {{-- フォロー解除フォームを閉じる --}}
            </form>

        {{-- まだフォローしていない場合の処理 --}}
        @else

            {{-- フォローするためのフォームを作る --}}
            <form action="{{ route('users.follow', $userId) }}" method="POST" class="home-follow-form">

                {{-- LaravelのCSRF対策。不正なフォーム送信を防ぐ --}}
                @csrf

                {{-- フォローするボタンを作る --}}
                <button type="submit" class="home-follow-button">

                    {{-- ボタンに表示する文字 --}}
                    フォローする

                {{-- ボタンを閉じる --}}
                </button>

            {{-- フォロー用フォームを閉じる --}}
            </form>

        {{-- フォロー中かどうかの条件分岐を終了する --}}
        @endif

    {{-- フォローボタンを表示するかどうかの条件分岐を終了する --}}
    @endif

{{-- 投稿カード全体を閉じる --}}
</article>