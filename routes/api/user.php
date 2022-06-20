<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders', 'middleware' => ['api', 'auth:api']], function () {
    Route::post('/', [App\Http\Controllers\Api\OrdersController::class, 'store']);
});
