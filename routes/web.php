<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;

// トップ画面
Route::get('/', function () {
    return view('top');
});

// ログイン画面
Route::get('/login', function () {
    return view('login');
});

// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->name('login.check');

// 新規登録画面
Route::get('/register', function () {
    return view('register');
});

// 新規登録処理
Route::post('/register', [AuthController::class, 'register']);

// ホーム画面：全体
Route::get('/home', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $posts = Post::with('user')
        ->latest()
        ->get();

    $followingIds = Follow::where('follower_id', $loginUserId)
        ->pluck('followed_id')
        ->toArray();

    return view('home', [
        'loginUser' => $loginUser,
        'posts' => $posts,
        'followingIds' => $followingIds,
        'activeTab' => 'all',
        'emptyMessage' => 'まだ投稿がありません。',
    ]);
})->name('home');

// ホーム画面：フォロー中
Route::get('/home/following', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $followingIds = Follow::where('follower_id', $loginUserId)
        ->pluck('followed_id')
        ->toArray();

    $posts = Post::with('user')
        ->whereIn('user_id', $followingIds)
        ->latest()
        ->get();

    return view('home', [
        'loginUser' => $loginUser,
        'posts' => $posts,
        'followingIds' => $followingIds,
        'activeTab' => 'following',
        'emptyMessage' => 'フォロー中の投稿はまだありません。',
    ]);
})->name('home.following');

// 投稿画面
Route::get('/post', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts', function (Request $request) {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $request->validate([
        'body' => ['required', 'string', 'max:140'],
    ], [
        'body.required' => '投稿内容を入力してください。',
        'body.max' => '投稿は140文字以内で入力してください。',
    ]);

    Post::create([
        'user_id' => $loginUserId,
        'body' => $request->body,
    ]);

    return redirect('/home');
});
// 投稿削除
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// プロフィール画面
Route::get('/profile', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $posts = Post::with('user')
        ->where('user_id', $loginUserId)
        ->latest()
        ->get();

    return view('profile', [
        'loginUser' => $loginUser,
        'posts' => $posts,
    ]);
});

// プロフィール編集画面
Route::post('/profile/edit', function (Request $request) {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    $request->validate([
        'account_id' => 'required|max:50|unique:users,account_id,' . $loginUser->id,
        'user_name' => 'required|max:50',
        'password' => ['nullable', 'string', 'max:50'],
        'profile_image' => ['nullable', 'image', 'max:2048'],
    ]);

    $profileImagePath = $loginUser->profile_image;

    if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
        if ($loginUser->profile_image) {
            Storage::disk('public')->delete($loginUser->profile_image);
        }

        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
    }

    $updateData = [
        'account_id' => $request->account_id,
        'user_name' => $request->user_name,
        'profile_image' => $profileImagePath,
    ];

    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    $loginUser->update($updateData);

    return redirect('/profile');
})->name('profile.update');

Route::get('/profile/edit', function () {
    $loginUserId = session('login_user_id');

    if ($loginUserId === null) {
        return redirect('/login');
    }

    $loginUser = User::find($loginUserId);

    if ($loginUser === null) {
        session()->forget('login_user_id');
        return redirect('/login');
    }

    return view('profile-edit', [
        'loginUser' => $loginUser,
    ]);
});

// フォロー処理
Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('users.follow');
Route::delete('/users/{user}/follow', [FollowController::class, 'destroy'])->name('users.unfollow');