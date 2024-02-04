<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

    Route::group(['middleware' => 'aws-cognito'], function() {
        Route::get('profile', [App\Http\Controllers\AuthController::class, 'profile']);
    });
});

Route::group(['middleware' => 'aws-cognito'], function() {
     Route::get('account', [App\Http\Controllers\AccountController::class, 'index']);
     Route::get('organisation', [App\Http\Controllers\OrganisationController::class, 'index']);
});
