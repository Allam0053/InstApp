<?php

use App\Http\Controllers\Comment\CreateController as CommentCreate;
use App\Http\Controllers\Comment\DeleteController as CommentDelete;
use App\Http\Controllers\Comment\UpdateController as CommentUpdate;
use App\Http\Controllers\Comment\ViewController as CommentView;
use App\Http\Controllers\Like\CreateController as LikeCreate;
use App\Http\Controllers\Like\DeleteController as LikeDelete;
use App\Http\Controllers\Like\UpdateController as LikeUpdate;
use App\Http\Controllers\Like\ViewController as LikeView;
use App\Http\Controllers\Post\CreateController as PostCreate;
use App\Http\Controllers\Post\DeleteController as PostDelete;
use App\Http\Controllers\Post\UpdateController as PostUpdate;
use App\Http\Controllers\Post\ViewController as PostView;
use App\Http\Controllers\User\ViewController as UserView;
use App\Http\Controllers\User\CreateController as UserCreate;
use App\Http\Controllers\User\UpdateController as UserUpdate;
use App\Http\Controllers\User\DeleteController as UserDelete;
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

Route::get('/', [PostView::class, 'index'])->name('home');

Route::group(['prefix' => '', 'middleware' => 'user'], function () {
    Route::get('/profile', [UserView::class, 'index'])->name('profile');

    Route::get('/post/new', [PostCreate::class, 'create'])->name('post.create.get');
    Route::post('/post/new', [PostCreate::class, 'store'])->name('post.create.post');
    Route::get('/post/{id}', [PostView::class, 'view'])->name('post.view');

    Route::put('/post/like', [LikeCreate::class, 'store'])->name('like');

    
    Route::post('/post/comment', [CommentCreate::class, 'store'])->name('comment.create');

    Route::put('/edit-comment', [CommentUpdate::class, 'store'])->name('comment.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
