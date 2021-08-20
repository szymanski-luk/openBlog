<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

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



Auth::routes();
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// HOME
Route::get('/', [PostController::class, 'list'])->name('home');

// POSTS
Route::get('/posts/new', [PostController::class, 'newPost'])->name('new_post');
Route::post('/posts/create', [PostController::class, 'createPost'])->name('create_post');
Route::get('/posts', [PostController::class, 'list'])->name('posts');
Route::get('/posts/category/{id}', [PostController::class, 'postsInCategory'])->name('posts_in_category');
Route::get('/posts/{id}', [PostController::class, 'details'])->name('post_detailed');
Route::post('/posts/edit', [PostController::class, 'editPost'])->name('edit_post');

// BLOG
Route::get('/blog/{id}', [PostController::class, 'usersPosts'])->name('blog');

// SETTINGS
Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
Route::post('/settings/save', [HomeController::class, 'saveSettings'])->name('save_settings');

// COMMENTS
Route::post('/comment/add', [CommentController::class, 'createComment'])->name('create_comment');

// REPLIES
Route::post('/reply/add', [ReplyController::class, 'createReply'])->name('create_reply');
