<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//API Routing Pictures
//Route::resource('pictures', PictureController::class);

//Public Routes
Route::prefix('photos')->group(function () {

    //Rating
    Route::get('ratings', [RatingController::class, 'index']);
    Route::get('ratings/{id}', [RatingController::class, 'show']);
    Route::get('{id}/ratings', [RatingController::class, 'ratingPhoto']);
    Route::post('ratings', [RatingController::class, 'store'])->name('api.rating.post');
    Route::put('{id}/ratings', [RatingController::class, 'update']);
    Route::delete('{id}/ratings', [RatingController::class, 'destroy']);

    //Comment
    Route::get('comments', [CommentController::class, 'index']);
    Route::get('comments/{id}', [CommentController::class, 'show']);
    Route::get('{id}/comments', [CommentController::class, 'commentPhoto']);
    Route::post('comments', [CommentController::class, 'store'])->name('api.comment.post');
    Route::put('{id}/comments', [CommentController::class, 'update']);
    Route::delete('{id}/comments', [CommentController::class, 'destroy']);




});

Route::prefix('users')->group(function () {

    //Follow
    Route::get('follows', [FollowController::class, 'index']);
    Route::get('follows/{id}', [FollowController::class, 'show']);
    Route::get('{id}/follows', [FollowController::class, 'followsUsers']);
    Route::post('follows', [FollowController::class, 'store'])->name('api.user.post');
    Route::put('{id}/follows', [FollowController::class, 'update']);
    Route::delete('{id}/follows', [FollowController::class, 'destroy']);


});



Route::get('/photos', [PhotoController::class, 'index']);
Route::get('/photos/{id}', [PhotoController::class, 'show']);
Route::get('/photos/search/{name}', [PhotoController::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/photos', [PhotoController::class, 'store']);
Route::put('/photos/{id}', [PhotoController::class, 'update']);

//Protected routes:
Route::group(['middleware' => ['auth:sanctum']], function () {



    Route::delete('/photos/{id}', [PhotoController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/photos', [PhotoController::class, 'index']);
