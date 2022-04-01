<?php

use App\Http\Controllers\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("map")->group(function () {
    Route::get('/', [MapController::class, 'index']);
    Route::post('/', [MapController::class, 'store']);
    Route::get('first', [MapController::class, 'show']);
    Route::put('{id}', [MapController::class, 'update']);
    Route::delete('{id}', [MapController::class, 'destroy']);
});
