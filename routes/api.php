<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImagenController;
use App\Http\Controllers\Api\UserController;
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
//AUTH
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//PERFIL
Route::post('perfil/user/{id}', [UserController::class, 'perfil']);
Route::post('perfil/user/password/{id}', [UserController::class, 'password_update']);
//FOTOGRAFIA
Route::post('analyze/imagen/fotografo/{id}', [ImagenController::class, 'analyze_image']);

