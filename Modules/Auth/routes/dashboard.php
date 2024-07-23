<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Dashboard\AddressesController;
use Modules\Auth\Http\Controllers\Dashboard\AdminAuthController;
use Modules\Auth\Http\Controllers\Dashboard\AdminController;
use Modules\Auth\Http\Controllers\Dashboard\CountryController;
use Modules\Auth\Http\Controllers\Dashboard\NotificationController;
use Modules\Auth\Http\Controllers\Dashboard\UserController;

Route::prefix('/dashboard')->group(function () {

    Route::post('/auth/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/auth/logout', [AdminAuthController::class, 'logout']);

        Route::prefix('admin')->controller(AdminController::class)->group(function () {
            Route::get('/', 'getAll');
            Route::get('/{id}', 'getOne');
            Route::post('/', 'create');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
        });

        Route::prefix('countries')->controller(CountryController::class)->group(function () {
            Route::get('/all', 'getAll');
            Route::post('/', 'create');
            Route::put('{id}', 'update');
            Route::delete('/{id}', 'delete');
        });

        Route::prefix('notification')->controller(NotificationController::class)->group(function () {
            Route::get('/', 'getAll');
            Route::post('/', 'create');

        });

    });

    Route::prefix('users')->controller(UserController::class)->group(function () {

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/all', 'getAll');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
            Route::post('/', 'create');
        });

    });

    Route::prefix('address')->controller(AddressesController::class)->group(function () {

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/', 'getAll');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'delete');
            Route::post('/', 'create');
        });

    });

});
