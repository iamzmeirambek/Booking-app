<?php

use App\Http\Controllers\api\v1\admin\HotelController;
use App\Http\Controllers\api\v1\Public\HotelSearchController;

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Support\Facades\Auth;
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

    Route::prefix('v1')->group(function () {
        Route::controller(HotelSearchController::class)->group(function () {
            Route::get('/search', 'index');
        });
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');
            Route::post('/forgot_password', 'forgot_password');
            Route::post('/reset_password', 'reset_password');
            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::post('/logout', 'logout');
            });
        });

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::prefix('admin/hotel')->group(function () {
                Route::controller(HotelController::class)->group(function () {
                    Route::get('/','index');
                    Route::get('/{hotel}','show');
                    Route::post('/store', 'store');
                    Route::put('/edit/{hotel}', 'update');
                    Route::delete('/delete/{hotel}', 'destroy');
                });
                Route::get('user/bookings',
                    [\App\Http\Controllers\api\v1\User\BookingController::class, 'index']);
            });
        });
    });
