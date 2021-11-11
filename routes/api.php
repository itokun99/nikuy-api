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

    // banners
    Route::get('/banners', 'Api\BannerController@index');
    Route::get('/class-banners', 'Api\BannerController@bannerKelas');

    //member
    Route::get('/members/{id}', 'Api\MemberController@getMemberById');
    Route::get('/members', 'Api\MemberController@getMembers');

    // event
    Route::get('/events', 'Api\EventController@getEvents');

    // province
    Route::get('/provinces', 'Api\ProvinceController@getProvinces');

    // membership
    Route::get('/membership/{id}', 'Api\MembershipController@getById');
    Route::get('/membership', 'Api\MembershipController@get');

    Route::middleware('api.auth')->group(function () {

        Route::get('/logout', 'Api\AuthController@logout');

        // profile photo
        Route::post('/profile/photo', 'Api\ProfileController@uploadPhoto');
        Route::delete('/profile/photo', 'Api\ProfileController@deletePhoto');

        // profile password
        Route::post('/profile/password', 'Api\ProfileController@updatePassword');

        // profile business
        Route::get('/profile/business/{id}', 'Api\BusinessController@getDetailUserBusiness');
        Route::get('/profile/business', 'Api\BusinessController@getUserBusiness');
        Route::delete('/profile/business/delete/{id}', 'Api\BusinessController@deleteUserBusiness');
        Route::post('/profile/business/edit/{id}', 'Api\BusinessController@editUserBusiness');
        Route::post('/profile/business/add', 'Api\BusinessController@createUserBusiness');

        // profile
        Route::get('/profile', 'Api\ProfileController@getProfile');
        Route::post('/profile', 'Api\ProfileController@updateProfile');

        // Bank
        Route::get('/banks', 'Api\BankController@get');

        // Payment
        Route::get('/payments', 'Api\PaymentController@get');

        // Transaction
        Route::get('/transactions/{id}', 'Api\TransactionController@getById');
        Route::get('/transactions', 'Api\TransactionController@get');
        Route::post('/transactions/update/{id}', 'Api\TransactionController@update');
        Route::post('/transactions/create', 'Api\TransactionController@create');

        // Kelas
        Route::get('/classes/{id}', 'Api\ClassController@getById');
        Route::get('/classes', 'Api\ClassController@get');

        // courses
        Route::get('/courses/{id}/submit-progress', 'Api\CourseController@submitProgress');
        Route::get('/courses/{id}', 'Api\CourseController@getById');

        // pillar
        Route::get('/pillars/{id}', 'Api\PillarController@getById');
    });
});
