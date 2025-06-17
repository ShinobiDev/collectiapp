<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\StatusController;

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

// Ruta para login (sin protección)
Route::post('login', [AuthController::class, 'login']);

// Ruta para logout (protegida)
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth.jwt');

// Route::middleware('auth.jwt')->group(function () {
//     Route::apiResource('statuses', StatusController::class);
// });

Route::middleware('custom.jwt')->group(function () {
    Route::apiResource('statuses', StatusController::class);
});

//Route::apiResource('statuses', StatusController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
