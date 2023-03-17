<?php

use App\Http\Controllers\UserController;
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

Route::post('/register',[UserController::class,'Register'])->name('user.Register');
Route::post('/login',[UserController::class,'Login'])->name('user.Login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/login/valid',[UserController::class,'IsLoginValid'])->name('user.login.valid');
    Route::get('/logout',[UserController::class,'Logout'])->name('user.logout');
    Route::get('/logout/all',[UserController::class,'LogoutAll'])->name('user.logout.all');
});

