<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;

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

Route::get('/galleries', [GalleriesController::class, 'index']);
Route::get('/authors/{user_id}', [UserController::class, 'userGalleries']);
Route::get('/galleries/{gallery}', [GalleriesController::class, 'show']);



Route::middleware('guest')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/galleries', [GalleriesController::class, 'store']);
    Route::get('/my-galleries', [GalleriesController::class, 'myGalleries']);
    Route::post('/galleries/{gallery}', [GalleriesController::class, 'update']);
    Route::delete('/galleries/{gallery}', [GalleriesController::class, 'destroy']);
    Route::post('/comments/{gallery}', [CommentsController::class, 'store']);
    Route::post('/comments/delete/{comment}', [CommentsController::class, 'destroy']);
});
