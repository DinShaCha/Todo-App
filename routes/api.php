<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application API Routes
|--------------------------------------------------------------------------
|
| This file is used to define the API routes for your application. These
| routes are automatically loaded by the RouteServiceProvider within
| the "api" middleware group. Build something exceptional!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
