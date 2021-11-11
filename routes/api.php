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

Route::prefix('v1')->group(function () {

    // authentication
    Route::post('/login', 'Api\AuthController@login');
    Route::post('/register', 'Api\AuthController@register');

    Route::middleware('api.auth')->group(function () {

        Route::get('/logout', 'Api\AuthController@logout');

        // profile photo
        Route::post('/profile/photo', 'Api\ProfileController@uploadPhoto');
        Route::delete('/profile/photo', 'Api\ProfileController@deletePhoto');

        // profile password
        Route::post('/profile/password', 'Api\ProfileController@updatePassword');

        // profile
        Route::get('/profile', 'Api\ProfileController@getProfile');
        Route::post('/profile', 'Api\ProfileController@updateProfile');
    });
});
