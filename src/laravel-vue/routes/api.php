<?php

use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
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
    return new UserResource($request->user());
});

Route::name('user.')->group(function () {

    Route::post('/register',[UserController::class,'Register'])->name('register');

    Route::prefix('login')->name('login')->group(function () {
        Route::post('',[UserController::class,'Login']);
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/valid',[UserController::class,'IsLoginValid'])->name('.valid');
            Route::get('/alive',[UserController::class, 'KeepTokenAlive'])->name('.alive');
        });
    });
    Route::prefix('logout')->name('logout')->middleware(['auth:sanctum'])->group(function () {
        Route::get('',[UserController::class,'Logout']);
        Route::get('/all',[UserController::class,'LogoutAll'])->name('.all');
    });
});

