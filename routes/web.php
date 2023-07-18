<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 投稿機能
Route::group(['prefix' => 'post'], function () {
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/index', [PostController::class, 'index'])->name('post.index');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    // いいね機能
    Route::post('/{id}/favorite', [FavoriteController::class, 'store'])->name('favorites.favorite');
    Route::delete('/{id}/unfavorite', [FavoriteController::class, 'destroy'])->name('favorites.unfavorite');
});

// ユーザーページ
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

// コメント機能
Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');

// フォロー機能
Route::post('users/{user}/follow', [UserController::class, 'follow'])->name('follow');
Route::delete('users/{user}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');
