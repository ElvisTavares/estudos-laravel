<?php

use App\Http\Controllers\Planet\PlanetController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('planets', [PlanetController::class, 'index']);
Route::get('planets/c', [PlanetController::class, 'saveToCache']);
Route::get('planets/list', [PlanetController::class, 'getInfo']);
