<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
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

// BLOG
Route::get('/blog/{id}', [PostController::class, 'usersPosts'])->name('blog');
