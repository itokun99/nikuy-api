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

    Route::get('/location/provinces', 'Api\LocationController@getProvinces');
    Route::get('/location/cities', 'Api\LocationController@getCities');
    Route::get('/location/districts', 'Api\LocationController@getDistricts');
    Route::get('/location/subdistricts', 'Api\LocationController@getSubdistricts');

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

        // my invitation
        Route::delete('/myinvitation/delete/{id}', 'Api\MyInvitationController@delete');
        Route::post('/myinvitation/edit/{id}', 'Api\MyInvitationController@edit');
        Route::post('/myinvitation/add', 'Api\MyInvitationController@add');
        Route::get('/myinvitation/{id}', 'Api\MyInvitationController@getById');
        Route::get('/myinvitation', 'Api\MyInvitationController@get');
    });
});
