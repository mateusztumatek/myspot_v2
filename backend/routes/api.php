<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', [\App\Http\Controllers\UserController::class, 'me'])->name('user.me');

Route::middleware('auth:sanctum')
    ->prefix('user')
    ->group(function (){
        Route::apiResource('notification-channels', \App\Http\Controllers\UserNotificationChannelController::class);
    });
