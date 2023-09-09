<?php

use App\Http\Controllers\Planet\PlanetController;
use App\Http\Controllers\uploadImageController;
use App\Models\Planet;
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

Route::get('planets', [PlanetController::class, 'index'])->middleware('rate.limit');
Route::post('planets/create', [PlanetController::class, 'store']);
Route::get('planets/{id}', [PlanetController::class, 'show']);
Route::get('planets/{planet}/satellites', function ($planet) {
    $planet = Planet::with('satellites')->findOrFail($planet);
    return $planet->satellites;
});

Route::patch('/planet/{planet}', function(Planet $planet, Request $request) {
    $planet->inhabited = $request->inhabited;
    $planet->save();
    return $planet;
});

Route::post('/upload', [uploadImageController::class, 'uploadImage'])->name('upload');