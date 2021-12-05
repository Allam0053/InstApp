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

    // authenticated activities goes here
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', [ApiView::class, 'getProfile'])->name('api.user.profile');
        Route::post('profile', [ApiUpdate::class, 'profile'])->name('api.user.profile.update');

        Route::post('posting', [ApiCreate::class, 'posting'])->name('api.user.posting');
        Route::post('posting/{id}', [ApiUpdate::class, 'posting'])->name('api.user.posting.edit');
        Route::get('posting/delete/{id}', [ApiDelete::class, 'posting'])->name('api.user.posting.delete');

        // authenticated user liking / disliking posting with id = {id}
        Route::get('liking/{id}', [ApiCreate::class, 'liking'])->name('api.user.liking');
    });
});

Route::get('get-asset-link', [ApiAuth::class, 'getAssetLink'])->name('api.asset-link');
Route::get('posts', [ApiView::class, 'getAllPosts'])->name('api.post.getall');
