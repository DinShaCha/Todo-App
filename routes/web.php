<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This file is where you can define the web routes for your application.
| These routes are loaded by the RouteServiceProvider and are assigned
| to the "web" middleware group. Build something amazing!
|
*/

Route::prefix('api')->group(function () {
    Route::get('/user-info', fn () => Auth::user())->name('user')->middleware('auth');

    Route::apiResource('tasks', TaskController::class);
});

// Universal route handler for Vue Router. This enables clean and user-friendly URLs in our Vue-powered SPA.
Route::get('/{path?}', HomeController::class)->where('path', '.*');
