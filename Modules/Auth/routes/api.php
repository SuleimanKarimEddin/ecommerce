<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\AuthController;
use Modules\Auth\Http\Controllers\Api\UserController;

Route::prefix('/auth')->controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/verify', 'verify');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'logout');

    });

});

Route::prefix('/user')->controller(UserController::class)->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', 'getProfile');
        Route::post('/profile', 'updateProfile');
        Route::post('/address', 'CreateAddress');
        Route::put('/address', 'updateAddress');
    });

});
