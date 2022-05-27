<?php

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

Route::middleware('client')->group(function () {
    Route::namespace('App\Http\Controllers\Auth')->group(function () {
        Route::post('auth/check-accessToken', 'AccessTokenController@checkAccessToken')->name('auth.checkAccessToken');
    });

    Route::namespace('App\Http\Controllers\Api')->group(function () {
        Route::get('jobs', 'jobController@get')->name('jobs.get');
    });
});
