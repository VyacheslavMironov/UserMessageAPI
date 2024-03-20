<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\CommentController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('user')->group(function (){
    Route::post('registration', [UserController::class, 'registration']);
    Route::post('auth', [UserController::class, 'auth']);
});

Route::prefix('message')->group(function () {
    Route::get('/', [MessageController::class, 'all']);
    Route::middleware(['access.user', 'access.auth.message'])->group(function () {
        Route::get('/show/{id}', [MessageController::class, 'show']);
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('message')->group(function (){
        Route::post('/create', [MessageController::class, 'create']);
        Route::put('/update', [MessageController::class, 'update']);
        Route::delete('/delete/{id}', [MessageController::class, 'delete']);
        Route::prefix('comment')->group(function (){
            Route::get('/{message_id}', [CommentController::class, 'all']);
            Route::post('/create', [CommentController::class, 'create']);
            Route::get('/show/{id}', [CommentController::class, 'show']);
            Route::put('/update', [CommentController::class, 'update']);
            Route::delete('/delete/{id}', [CommentController::class, 'delete']);
        });
    });
});
