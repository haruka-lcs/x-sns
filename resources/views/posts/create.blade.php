@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <div class="post-create-page">
        <header class="post-create-header">
            <h1>投稿する</h1>
        </header>

        <form action="{{ route('posts.store') }}" method="POST" class="post-create-form">
            @csrf

            <textarea
                name="body"
                class="post-create-textarea"
                placeholder="いまどうしてる？"
            >{{ old('body') }}</textarea>

            @error('body')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit" class="post-create-button">
                投稿
            </button>
        </form>
    </div>
@endsection