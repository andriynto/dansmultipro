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

        Route::get('roles',             'RoleController@index')->name('role.index')->middleware('client:read-auth-roles');
        Route::get('roles/{id}',        'RoleController@get')->name('role.show')->middleware('client:read-auth-roles');
        Route::post('roles',            'RoleController@store')->name('role.store')->middleware('client:create-auth-roles');
        Route::patch('roles/{id}',      'RoleController@update')->name('role.update')->middleware('client:update-auth-roles');
        Route::delete('roles/{id}',     'RoleController@des\troy')->name('role.destroy')->middleware('client:delete-auth-roles');

        Route::get('permissions/action',    'PermissionController@action')->name('permission.action')->middleware('client:read-auth-permissions');
        Route::get('permissions',           'PermissionController@index')->name('permission')->middleware('client:read-auth-permissions');
        Route::get('permissions/{id}',      'PermissionController@get')->name('permission.show')->middleware('client:read-auth-roles');
        Route::post('permissions',          'PermissionController@store')->name('permission.store')->middleware('client:create-auth-permissions');
        Route::patch('permissions',         'PermissionController@update')->name('permission.update')->middleware('client:read-auth-permissions');
        Route::delete('permissions/{id}',   'PermissionController@destroy')->name('permission.destroy')->middleware('client:delete-auth-permissions');

        Route::get('auth/user/{id}', 'UserController@show')->name('user.show');
        Route::post('auth/user/{id}','UserController@store')->name('user.store');
        Route::post('auth/user/password/{id}','UserController@resetPassword')->name('user.password');
    });
});
