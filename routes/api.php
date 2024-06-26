<?php

use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\EquipmentsController;
use App\Http\Controllers\Api\TypesController;
use App\Http\Controllers\Api\UsersController;
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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('users', UsersController::class);
    Route::apiResource('types', TypesController::class);
    Route::apiResource('equipments', EquipmentsController::class);
    Route::apiResource('carts', CartsController::class);
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
