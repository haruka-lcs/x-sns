@extends('layouts.app')

@section('title', '投稿')

@section('content')
    <div class="post-page">
        <header class="post-header">
            <h1>投稿</h1>
        </header>

        <form class="post-form" action="/home" method="GET">
            <div class="post-compose">
                <div class="compose-avatar"></div>

                <textarea
                    name="body"
                    class="compose-textarea"
                    placeholder="いまどうしてる？"
                ></textarea>
            </div>

            <button type="submit" class="post-submit-button">
                投稿する
            </button>
        </form>

        <x-bottom-nav active="post" />
    </div>
@endsection