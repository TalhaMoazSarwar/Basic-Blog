<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
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

// Auth Routes
Auth::routes();

// Page Routes
Route::get('/', [PageController::class, 'index'])->name('page.index');

// Post Routes
Route::resource('post', PostController::class);

// Post Like/Dislike Routes
Route::post('post/{post}/like', [PostController::class, 'like'])->name('post.like');
Route::post('post/{post}/dislike', [PostController::class, 'dislike'])->name('post.dislike');

// Post Comment Routes
Route::post('post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');

// Post Comment Like/Dislike Routes
Route::post('comment/{comment}/like', [CommentController::class, 'like'])->name('comment.like');
Route::post('comment/{comment}/dislike', [CommentController::class, 'dislike'])->name('comment.dislike');

// Comment Reply Like/Dislike Routes
Route::post('reply/{reply}/like', [ReplyController::class, 'like'])->name('reply.like');
Route::post('reply/{reply}/dislike', [ReplyController::class, 'dislike'])->name('reply.dislike');