<?php

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\Api\PaymentController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::controller(PaymentController::class)->prefix('payment')->group(function () {

    Route::middleware(['auth:sanctum'])->post('/checkout', 'checkout');

    Route::get('/success', 'success')->name('payment.success');
    Route::get('/cancel', 'cancel')->name('payment.cancel');
});
