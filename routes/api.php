<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RifaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/


/* Login */
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');

/* Usuario */
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

/* Rifa */
    Route::post('/rifas', [RifaController::class, 'store']);
    Route::get('/rifas', [RifaController::class, 'index']);
    Route::get('/rifas/{id}', [RifaController::class, 'show']);
    Route::put('/rifas/{id}', [RifaController::class, 'update']);
    Route::delete('/rifas/{id}', [RifaController::class, 'destroy']);







    

    // routes/api.php
    Route::options('/{any}', function () {
        return response()->json(['status' => 'success']);
    })->where('any', '.*');
