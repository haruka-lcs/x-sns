<?php

namespace App\Providers;
// このファイルが App\Providers の中にあることを示す
// Providerファイル用の名前空間

use Illuminate\Support\ServiceProvider;
// LaravelのServiceProviderクラスを使うための読み込み
// アプリ起動時の設定や準備処理を書くために使う

class AppServiceProvider extends ServiceProvider
// AppServiceProviderクラスを定義する
// ServiceProviderを継承しているので、Laravelのサービスプロバイダーとして使える
{
    /**
     * Register any application services.
     */
    // アプリで使うサービスを登録する場所、という説明コメント

    public function register(): void
    // registerメソッドを定義する
    // アプリのサービス登録処理を書く場所
    // : void は、このメソッドが値を返さないという意味
    {
        //
        // 今は何も処理を書いていない
    }

    /**
     * Bootstrap any application services.
     */
    // アプリ起動時に必要な初期設定を書く場所、という説明コメント

    public function boot(): void
    // bootメソッドを定義する
    // アプリ起動時に実行したい処理を書く場所
    // : void は、このメソッドが値を返さないという意味
    {
        //
        // 今は何も処理を書いていない
    }
}