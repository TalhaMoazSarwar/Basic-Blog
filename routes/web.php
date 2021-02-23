<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
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
Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::resource('post', PostController::class);
Route::post('post/{post}/like', [PostController::class, 'like'])->name('post.like');
Route::post('post/{post}/dislike', [PostController::class, 'dislike'])->name('post.dislike');
Route::post('post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('comment/{comment}/like', [CommentController::class, 'like'])->name('comment.like');
Route::post('comment/{comment}/dislike', [CommentController::class, 'dislike'])->name('comment.dislike');