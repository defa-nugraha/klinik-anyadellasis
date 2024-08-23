<?php

use App\Http\Controllers\API\DepositControllerAPI;
use App\Http\Controllers\API\RegisterControllerAPI;
use App\Http\Controllers\API\TripayControllerAPI;
use App\Http\Controllers\Payment\TripayCallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Hello World', 200);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {});

Route::prefix('callback')->group(function () {});
