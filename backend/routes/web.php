<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $cart = [
        [
            "name" => "Red Shoes",
            "price" => 101.01,
            "quantity" => 5,
            "discount" => 55
        ],
        [
            "name" => "Blue bag",
            "price" => 262.21,
            "quantity" => 1,
            "discount" => 40
        ],
        [
            "name" => "Green hat",
            "price" => 322.22,
            "quantity" => 7,
            "discount" => 0
        ],
        [
            "name" => "Gray socks",
            "price" => 425.03,
            "quantity" => 2,
            "discount" => 62
        ]
    ];

    return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (\Illuminate\Http\Request $request) {
    return $request->user();
});

Route::get('/test', function (){
    $user = \App\Models\User::first();
    $user->notify(new \App\Notifications\TestNotification());
});
