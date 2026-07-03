@extends('layouts.app')

@section('title', 'トップ')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
    <div class="top-page">
        <div class="top-button-area">
            <a href="/login" class="top-button top-login-button">
                ログイン
            </a>

            <a href="/register" class="top-button top-register-button">
                新規登録
            </a>
        </div>
    </div>
@endsection