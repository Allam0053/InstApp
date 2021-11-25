<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CreateController as ApiCreate;
use App\Http\Controllers\Api\ViewController as ApiView;
use App\Http\Controllers\Api\DeleteController as ApiDelete;
use App\Http\Controllers\Api\UpdateController as ApiUpdate;

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

Route::get('/foto', [ApiView::class, 'getAll'])->name('api.getall');
Route::post('/upfoto', [ApiCreate::class, 'upFoto'])->name('api.upfoto');
Route::get('/foto/{id}', [ApiDelete::class, 'deletePhotoFromApi'])->name('api.delete');
