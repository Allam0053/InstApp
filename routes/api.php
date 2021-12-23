<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CreateController as ApiCreate;
use App\Http\Controllers\Api\ViewController as ApiView;
use App\Http\Controllers\Api\DeleteController as ApiDelete;
use App\Http\Controllers\Api\UpdateController as ApiUpdate;
use App\Http\Controllers\Api\AuthController as ApiAuth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function () {
    $old = 'this text';
    $new = $old;
    $new = $new . ' new';
    return response($old);
});

// camerapp api
Route::get('foto', [ApiView::class, 'getAll'])->name('api.getall');
Route::post('upfoto', [ApiCreate::class, 'upFoto'])->name('api.upfoto');
Route::get('foto/{id}', [ApiDelete::class, 'deletePhotoFromApi'])->name('api.delete');

// instapp api
Route::group(['prefix' => 'user'], function () {
    Route::post('login', [ApiAuth::class, 'login'])->name('api.login');
    Route::post('register', [ApiAuth::class, 'register'])->name('api.register');
    Route::get('profile/{id}', [ApiView::class, 'getProfileById'])->name('api.user.profile.byid');
    Route::get('favourites', [ApiView::class, 'getFavouritesPosts'])->name('api.post.favourites');

    // authenticated activities goes here
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', [ApiView::class, 'getProfile'])->name('api.user.profile');
        Route::post('profile', [ApiUpdate::class, 'profile'])->name('api.user.profile.update');

        Route::group(['prefix' => 'posting'], function () {
            Route::post('', [ApiCreate::class, 'posting'])->name('api.user.posting');
            Route::post('{id}', [ApiUpdate::class, 'posting'])->name('api.user.posting.edit');
            Route::get('delete/{id}', [ApiDelete::class, 'posting'])->name('api.user.posting.delete');
        });

        // authenticated user liking / disliking posting with id = {id}
        Route::get('liking/{id}', [ApiCreate::class, 'liking'])->name('api.user.liking');

        Route::group(['prefix' => 'comment'], function () {
            Route::post('create', [ApiCreate::class, 'createComment'])->name('api.comment');
            Route::post('edit/{id}', [ApiUpdate::class, 'editComment'])->name('api.comment.edit');
            Route::get('delete/{id}', [ApiDelete::class, 'deleteComment'])->name('api.comment.delete');
        });

        Route::group(['prefix' => 'chat'], function () {
            Route::get('all', [ApiView::class, 'getAllChat'])->name('api.chat.all.group');
            Route::get('{id}', [ApiView::class, 'getChatById'])->name('api.chat.byid');
            Route::post('create-group', [ApiCreate::class, 'createGroup'])->name('api.chat.group.new');
            Route::get('delete-group/{id}', [ApiDelete::class, 'deleteGroupChat'])->name('api.chat.group.delete');
            //adding and kicking someone
            Route::post('group-invite-people', [ApiUpdate::class, 'invitePeople'])->name('api.chat.group.invite');
            Route::post('group-kick-people', [ApiUpdate::class, 'kickPeople'])->name('api.chat.group.kick');

            Route::post('send-chat', [ApiCreate::class, 'sendChat'])->name('api.chat.send');
            Route::post('edit-chat/{id}', [ApiUpdate::class, 'editChat'])->name('api.chat.edit');
            Route::get('delete-chat/{id}', [ApiDelete::class, 'deleteChat'])->name('api.chat.delete');
        });
    });
});

Route::get('get-asset-link', [ApiAuth::class, 'getAssetLink'])->name('api.asset-link');
Route::get('posts', [ApiView::class, 'getAllPosts'])->name('api.post.getall');
Route::get('posts/{id}', [ApiView::class, 'getPostById'])->name('api.post.byid');

Route::get('search-user/{keyword}', [ApiView::class, 'getUserByKeyword']);

Route::group(['prefix' => 'comment'], function () {
    Route::get('by-post-id/{id}', [ApiView::class, 'getCommentByPostId'])->name('api.comment.bypostid');
    Route::get('by-user-id/{id}', [ApiView::class, 'getCommentByUserId'])->name('api.comment.byuserid');
});
// TODO comment 


Route::get('/followers/{id}', [ApiView::class, 'getFollowerById'])->name('api.get.followers');
