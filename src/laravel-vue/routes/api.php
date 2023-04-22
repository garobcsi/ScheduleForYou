<?php

use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserCompanyFavouriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\UserTimeDateContoroller;
use App\Http\Controllers\UserTimeGroupsContoroller;
use App\Http\Controllers\UserTimeRoutineContoroller;
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
/// Admin
Route::name('admin.')->prefix('admin')->group(function () {
    Route::post('/register',[UserAdminController::class,'Register'])->name('register');

});
///

Route::name('user.')->group(function () {
    Route::prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('',[UserController::class,'getMyUser'])->name('my');
            Route::delete('',[UserController::class,'DeleteAccount'])->name('delete');
            Route::prefix('settings')->name('settings.')->group(function () {
                Route::get('',[UserSettingsController::class,'get'])->name('get');
                Route::post('',[UserSettingsController::class,'update'])->name('post');
            });
        });
        Route::get('/getByEmail',[UserController::class,'getUserByEmail'])->name('get');
        Route::get('/exists',[UserController::class,'doesUserExist'])->name('exists');

        Route::name('time')->middleware('auth:sanctum')->group(function () {
            Route::name('Date.')->prefix('date')->group(function () {
                Route::get('',[UserTimeDateContoroller::class,'index'])->name('get');
                Route::get('/group',[UserTimeDateContoroller::class,'indexWithGroups'])->name('group');
                Route::get('/{date}',[UserTimeDateContoroller::class,'show'])->whereNumber('date')->name('show');
                Route::post('',[UserTimeDateContoroller::class,'store'])->name('post');
                Route::post('/{date}',[UserTimeDateContoroller::class,'update'])->whereNumber('date')->name('update');
                Route::delete('/{date}',[UserTimeDateContoroller::class,'destroy'])->whereNumber('date')->name('delete');
            });
            Route::name('Routine.')->prefix('routine')->group(function () {
                Route::get('',[UserTimeRoutineContoroller::class,'index'])->name('get');
                Route::get('/group',[UserTimeRoutineContoroller::class,'indexWithGroups'])->name('group');
                Route::get('/{date}',[UserTimeRoutineContoroller::class,'show'])->whereNumber('date')->name('show');
                Route::post('',[UserTimeRoutineContoroller::class,'store'])->name('post');
                Route::post('/{date}',[UserTimeRoutineContoroller::class,'update'])->whereNumber('date')->name('update');
                Route::delete('/{date}',[UserTimeRoutineContoroller::class,'destroy'])->whereNumber('date')->name('delete');
            });
            Route::name('Groups.')->prefix('groups')->group(function () {
                Route::get('',[UserTimeGroupsContoroller::class,'index'])->name('get');
                Route::get('/{date}',[UserTimeGroupsContoroller::class,'show'])->whereNumber('date')->name('show');
                Route::post('',[UserTimeGroupsContoroller::class,'store'])->name('post');
                Route::post('/{date}',[UserTimeGroupsContoroller::class,'update'])->whereNumber('date')->name('update');
                Route::delete('/{date}',[UserTimeGroupsContoroller::class,'destroy'])->whereNumber('date')->name('delete');
            });
        });
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
            Route::get('/{company}',[CompanyController::class,'getAllContributors'])->whereNumber('company')->name('.getAll');
            Route::post('/{company}',[CompanyController::class,'addContributor'])->whereNumber('company')->name('.add');
            Route::post('/update/{company}',[CompanyController::class,'updateContributorPerms'])->whereNumber('company')->name('.update');
            Route::get('/leave/{company}',[CompanyController::class,'leaveContributor'])->whereNumber('company')->name('.leave');
            Route::post('/kick/{company}',[CompanyController::class,'kickContributor'])->whereNumber('company')->name('.kick');
        });

        Route::prefix('favourite')->name('favourite.')->group(function () {
            Route::get('',[UserCompanyFavouriteController::class,'index'])->name('index');
            Route::get('/company',[UserCompanyFavouriteController::class,'indexWithCompany'])->name('indexWC');
            Route::get('/{company}',[UserCompanyFavouriteController::class,'isItFavourite'])->whereNumber('company')->name('isItFavourite');
            Route::get('/add/{company}',[UserCompanyFavouriteController::class,'add'])->whereNumber('company')->name('add');
            Route::delete('/remove/{favourite}',[UserCompanyFavouriteController::class,'remove'])->whereNumber('favourite')->name('remove');
        });
    });
});
