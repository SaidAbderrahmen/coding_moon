<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TipController;
use App\Http\Controllers\Api\HiveController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\BeekeeperController;
use App\Http\Controllers\Api\NotificationController;

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


Route::name('api.')->group(function () {
    
    Route::post('login', [BeekeeperController::class, 'login']);


});

    Route::group(['middleware' => 'auth:api'],function () {
    Route::get('logout', [BeekeeperController::class, 'logout']);
    Route::get('beekeepers', [BeekeeperController::class, 'show']);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('tips', [TipController::class, 'index']);


    
   

    });