<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
// use App\Http\Controllers\Auth\LoginController ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('posts',PostController::class);


Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return 'hello';
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::post('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::delete('/posts/{postId}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');


Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->stateless()->redirect();
})->name('auth.github');
Route::get('/auth/callback', function () {
    // dd('dkfmkfm');

    $user = Socialite::driver('github')->stateless()->user();

    dd($user);
    // $user->token ->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
});

Route::get('/google/redirect', function () {
    return Socialite::driver('google')->stateless()->redirect();
})->name('auth.google');
Route::get('google/callback', function () {
    // dd('dkfmkfm');

    $user = Socialite::driver('google')->stateless()->user();

    // dd($user);
    // $user->token ->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
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect()->route('posts.index');
});

Route::get('google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::where('google_id', $googleUser->id)->first();

    if ($user) {
        $user->update([
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $googleUser->nickname,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect()->route('posts.index');
});