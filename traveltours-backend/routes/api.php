<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponsController;
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
    Route::post('/login', [AuthController::class, 'login']); //->middleware('throttle:5|60,1');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => ['api', 'auth:api']
], function () {
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
        Route::post('update', [UserController::class, 'update'])->name('update');
        Route::post('update-image', [UserController::class, 'updateImage'])->name('update');
        Route::get('/profile', [UserController::class, 'me']);
        Route::post('change-password', [UserController::class, 'changePassword'])->name('change');
    });

    Route::group(['prefix' => '/place'], function () {
        Route::post('/store', [PlaceController::class, 'store'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/update', [PlaceController::class, 'update'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/delete', [PlaceController::class, 'delete'])
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/review'], function () {
        Route::post('/store', [ReviewController::class, 'store']);
        Route::post('/update', [ReviewController::class, 'update'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/delete', [ReviewController::class, 'delete'])
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/tour'], function () {
        Route::post('/store', [TourController::class, 'store'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/update', [TourController::class, 'update'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/delete', [TourController::class, 'delete'])
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/category'], function () {
        Route::post('/store', [CategoryController::class, 'store'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/update', [CategoryController::class, 'update'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/delete', [CategoryController::class, 'delete'])
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/tour-guide'], function () {
        Route::post('/store', [TourGuideController::class, 'store'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/update', [TourGuideController::class, 'update'])
            ->middleware(MID_ROLE_ADMIN);
        Route::post('/delete', [TourGuideController::class, 'delete'])
            ->middleware(MID_ROLE_ADMIN);
    });

    Route::group(['prefix' => '/order', 'middleware' => 'auth'], function () {
        Route::get('/listing', [OrderController::class, 'listing']);
        Route::post('/store', [OrderController::class, 'store']);
        Route::post('/update', [OrderController::class, 'update']);
        Route::post('/delete', [OrderController::class, 'delete']);
        Route::post('/accept', [OrderController::class, 'accept']);
    });

    Route::group(['prefix' => '/coupon', 'middleware' => MID_ROLE_ADMIN], function (){
        Route::post('/store', [CouponsController::class, 'store']);
        Route::post('/update', [CouponsController::class, 'update']);
        Route::post('/delete', [CouponsController::class, 'delete']);
    });
});

Route::get('review/listing', [ReviewController::class, 'listing']);
Route::get('tour/listing', [TourController::class, 'listing']);
Route::get('place/listing', [PlaceController::class, 'listing']);
Route::get('coupon/listing', [CouponsController::class, 'listing']);
Route::get('coupon/detail/{id}', [CouponsController::class, 'detail']);
Route::get('place/detail/{id}', [PlaceController::class, 'detail']);
Route::get('category/listing', [CategoryController::class, 'listing']);
Route::get('tour/detail/{id}', [TourController::class, 'detail']);
Route::get('tour-guide/listing', [TourGuideController::class, 'listing']);
Route::get('order/detail/{id}', [OrderController::class, 'detail']);
Route::get('order/all/{id}', [OrderController::class, 'all']);
Route::get('coupon/check/{couponCode}', [CouponsController::class, 'checkCouponCode']);
Route::get('order/check-book-tour/{tourId}/{userId}', [OrderController::class, 'checkBookTour']);

Route::get('vietnam-address', function () {
    return  response()->file("data.json");
});
