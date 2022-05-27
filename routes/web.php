<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function() {
    Route::namespace('App\Http\Controllers')->group(function() {
        Route::namespace('Auth')->group(function() {
            Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
            Route::post('login', ['as' => 'login.store', 'uses' => 'LoginController@store']);

            Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@index']);
            Route::post('/register', ['as' => 'register.store', 'uses' => 'RegisterController@store']);

            Route::get('/forget-password', ['as' => 'forget', 'uses' => 'ForgotPasswordController@showForgetPasswordForm']);
            Route::post('/forget-password', ['as' => 'forget.request', 'uses' => 'ForgotPasswordController@submitForgetPasswordForm']);
            Route::get('/reset-password/{token}', ['as' => 'reset.password.get', 'uses' => 'ForgotPasswordController@showResetPasswordForm']);
            Route::post('/reset-password', ['as' => 'reset.password.post', 'uses' => 'ForgotPasswordController@submitResetPasswordForm']);
        });
    });
});

Route::middleware(['auth'])->group(function() {
    Route::namespace('App\Http\Controllers\Auth')->group(function() {
        Route::get('logout', 'LoginController@destroy')->name('logout');
    });

    Route::group(['namespace' => '\App\Http\Controllers'], (function () {

        Route::prefix('auth')->group(function() {
            Route::get('verify',                      'Auth\VerifyController@show');
            Route::post('verify',                     'Auth\VerifyController@store');
            Route::post('verify/pin',                 'Auth\VerifyController@get');

            Route::get('access-token',                'Auth\AccessTokenController@show');
            Route::post('access-token',                'Auth\AccessTokenController@store');
        });

        Route::middleware(['unverified', 'access.token'])->group(function() {
            Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
            Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

            Route::get('/jobs/lists', ['as' => 'dashboard', 'uses' => 'DashboardController@lists']);
        });
    }));
});