<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::prefix('/oauth')->group(function(){

    Route::get('{oauth_provider}/redirect', [\App\Http\Controllers\OauthLoginController::class, 'redirect']);
    Route::get('{oauth_provider}/callback', [\App\Http\Controllers\OauthLoginController::class, 'callback']);
});
