<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Auth\ManualResetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home.index');

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Auth::routes();

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow');
Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])->name('unfollow');

Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations.index');
Route::get('/search-users', [UserController::class, 'search'])->name('users.search');

Route::get('/manual-reset', [ManualResetController::class, 'showForm'])->name('manual.reset.form');
Route::post('/manual-reset', [ManualResetController::class, 'process'])->name('manual.reset.process');

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show')->middleware('auth');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy')->middleware('auth');
Route::get('/messages/fetch/{user}', [MessageController::class, 'fetch'])->name('messages.fetch')->middleware('auth');
