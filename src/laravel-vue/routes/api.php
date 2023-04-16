<?php

use App\Http\Controllers\CompanyController;
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

Route::name('user.')->group(function () {

    Route::prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('',[UserController::class,'getMyUser'])->name('my');
        });
        Route::get('/getByEmail',[UserController::class,'getUserByEmail'])->name('get');
        Route::get('/exists',[UserController::class,'doesUserExist'])->name('exists');

    });

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

Route::prefix('company')->name('company.')->group(function () {
    Route::get('',[CompanyController::class,'index'])->name('index');
    Route::get('/{company}',[CompanyController::class,'show'])->whereNumber('company')->name('show');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/my',[CompanyController::class,'my'])->name('my');

        Route::post('',[CompanyController::class,'store'])->name('post');
        Route::post('/{company}',[CompanyController::class,'update'])->whereNumber('company')->name('update');
        Route::delete('/{company}',[CompanyController::class,'destroy'])->whereNumber('company')->name('destroy');

        Route::prefix('contributor')->name('contributor')->group(function () {
            Route::get('/{company}',[CompanyController::class,'getAllContributors'])->name('.getAll');
            Route::post('/{company}',[CompanyController::class,'addContributor'])->name('.set');
            Route::post('/update/{company}',[CompanyController::class,'updateContributorPerms'])->name('.update');
            Route::get('/leave/{company}',[CompanyController::class,'leaveContributor'])->name('.leave');
            Route::post('/kick/{company}',[CompanyController::class,'kickContributor'])->name('.kick');
        });
    });
});
