<?php

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

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout' , [\App\Http\Controllers\API\AuthController::class, 'logout']);

    //Route::apiResource('users',\App\Http\Controllers\API\userController::class);
    Route::get('users/{id}' , [\App\Http\Controllers\API\userController::class, 'show']);
    Route::put('users/{id}' , [\App\Http\Controllers\API\userController::class, 'update']);

    Route::post('songs' , [\App\Http\Controllers\API\SongController::class, 'store']);
    Route::post('songs/{id}/{user_id}' , [\App\Http\Controllers\API\SongController::class, 'delete']);

    Route::get('inside-middleware', function (){
        return response()->json('Success' , 200);
    });
});


Route::post('/register' , [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login' , [\App\Http\Controllers\API\AuthController::class, 'login']);

