@extends('layouts.app')

@section('title', '投稿')

@section('content')
    <div class="post-page">
        <header class="post-header">
            <h1>投稿</h1>
        </header>

        <form class="profile-edit-form" action="{{ route('profile.update') }}" method="POST">
    @csrf

    <div class="profile-edit-avatar"></div>

    <div class="profile-edit-input-row">
        <label for="account_id">ユーザーID</label>
        <input
            type="text"
            id="account_id"
            name="account_id"
            value="tanaka"
        >
    </div>

        <x-bottom-nav active="post" />
    </div>
@endsection