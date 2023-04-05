<?php

use App\Http\Controllers\API\V1\AuthController;
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
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');

            Route::group(['middleware' => ['auth:sanctum']], function () {
                Route::post('/logout', 'logout');
            });
        });
        Route::prefix('hotel')->group(function () {
            Route::controller(\App\Http\Controllers\api\v1\HotelController::class)->group(function () {
                Route::get('/','index');
                Route::get('/{hotel}','show');
                Route::post('/store', 'store');
                Route::put('/edit/{hotel}', 'update');
                Route::delete('/delete/{hotel}', 'destroy');
            });
        });
        Route::middleware('auth:sanctum')->group(function() {
            Route::get('user/bookings',
                [\App\Http\Controllers\api\v1\User\BookingController::class, 'index']);
        });
    });

