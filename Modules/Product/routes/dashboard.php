<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Dashboard\AttributeController;
use Modules\Product\Http\Controllers\Dashboard\AttributeValuesController;
use Modules\Product\Http\Controllers\Dashboard\CategoryController;
use Modules\Product\Http\Controllers\Dashboard\ProductController;
use Modules\Product\Http\Controllers\Dashboard\ProductVariationController;
use Modules\Product\Http\Controllers\Dashboard\ReviewController;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

    Route::prefix('product_variation')->controller(ProductVariationController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

    Route::prefix('/attribute')->controller(AttributeController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::post('/', 'create');
        Route::put('/{name}', 'update');
        Route::delete('/{name}', 'delete');
    });

    Route::prefix('/attribute_values')->controller(AttributeValuesController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::post('/', 'create');
        Route::put('/{value}', 'update');
        Route::delete('/{value}', 'delete');
    });
    Route::prefix('/review')->controller(ReviewController::class)->group(function () {
        Route::get('/', 'getAll');
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});
