@extends('layouts.app')

@section('title', '投稿')

@section('content')
    <div class="post-page">
        <header class="post-header">
            <h1>投稿</h1>
        </header>

        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
            @csrf

            <div class="post-compose">
                <div class="compose-avatar"></div>

                <textarea
                    name="body"
                    class="compose-textarea"
                    placeholder="いまどうしてる？"
                >{{ old('body') }}</textarea>

                <button type="submit" class="post-submit-button">
                    投稿する
                </button>
            </div>

            @error('body')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </form>

        <x-bottom-nav active="post" />
    </div>
@endsection