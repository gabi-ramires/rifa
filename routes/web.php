<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return ["Rifa-api", now()->toDateTimeString(), config('app.env')];
})->middleware('throttle:10,1');

Route::get('/api', function () {
    return 'API ok';
});
