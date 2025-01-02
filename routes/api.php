<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SkinController;
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

Route::prefix('/v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/skin/{username}', [SkinController::class, 'getSkin']);
    Route::get('/cape/{username}', [SkinController::class, 'getCape']);
});
