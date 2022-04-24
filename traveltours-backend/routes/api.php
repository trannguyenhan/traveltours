<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5|60,1');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => ['api', 'auth:api']
], function(){
    Route::group(['prefix' => '/user'], function () {
        Route::post('assign', [UserController::class, 'assignAccount'])->name('assign')
            ->middleware(MID_ROLE_ADMIN);
        Route::post('lock', [UserController::class, 'lockUser'])->name('lock')
            ->middleware(MID_ROLE_ADMIN);
        Route::post('unlock', [UserController::class, 'unlockUser'])->name('unlock')
            ->middleware(MID_ROLE_ADMIN);
        Route::post('delete', [UserController::class, 'delete'])->name('delete')
            ->middleware(MID_ROLE_ADMIN);
        Route::post('mass-delete', [UserController::class, 'massDelete'])->name('mass-delete')
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/user'], function () {
        Route::get('/listing', [UserController::class, 'listing'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('update', [UserController::class, 'update'])->name('update')
            ->middleware(MID_ROLE_ADMIN_OWN);
        Route::get('/profile', [UserController::class, 'me']);
        Route::post('change-password', [UserController::class, 'changePassword'])->name('change')
            ->middleware(MID_ROLE_ADMIN_OWN);
    });
});
