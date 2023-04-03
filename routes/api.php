<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;

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
        Route::controller(\App\Http\Controllers\api\v1\AuthController::class)->group(function () {
            Route::post('/register', 'register');
            Route::post('/login', 'login');

//            Route::group(['middleware' => ['auth:sanctum']], function () {
//                Route::get('/posts', [UserController::class, 'search']);
//            });
        });
    });

