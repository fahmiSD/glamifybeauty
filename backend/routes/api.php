<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me',[AuthController::class, 'me']);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'reviews'

], function ($router) {

    Route::get('all', [ReviewsController::class, 'index']);
    Route::get('top_review', [ReviewsController::class, 'top_review']);
    Route::post('add', [ReviewsController::class, 'add_review']);
    Route::post('upvote', [ReviewsController::class, 'upvote']);
    Route::get('count', [ReviewsController::class, 'count_reviews']);

});