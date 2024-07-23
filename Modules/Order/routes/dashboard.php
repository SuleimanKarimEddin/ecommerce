<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\Dashboard\OrderController;

Route::prefix('/order')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [OrderController::class, 'getAll']);
    Route::get('{id}', [OrderController::class, 'getOne']);

    Route::put('{id}/{status}', [OrderController::class, 'changeStatus']);
});
