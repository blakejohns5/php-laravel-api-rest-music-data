<?php

use App\Http\Controllers\GenresController;
use App\Http\Controllers\ArtistsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/users', [UsersController::class, 'index']);
// Route::get('/users/{user}', [UsersController::class, 'show']);
// Route::post('/users', [UsersController::class, 'store']);
// Route::patch('/users/{user}', [UsersController::class, 'update']);
// Route::delete('/users/{user}', [UsersController::class, 'destroy']);


Route::apiResource('genres', GenresController::class);
Route::apiResource('artists', ArtistsController::class);


Route::post('/songs', [SongsController::class, 'store']);
