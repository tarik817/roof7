<?php

Route::namespace('Api')->group(function () {
    // Auth.
    Route::namespace('Auth')->prefix('/user')->group(function () {
        Route::post('/register', 'RegisterController@register');
        Route::post('/login', 'LoginController@login');
        Route::get('/social/login/{socialNetwork}', 'LoginController@loginWithSocial');
        Route::get('/refresh', 'LoginController@refresh');
        Route::get('/user', 'LoginController@user');
        Route::post('/logout', 'LoginController@logout')->middleware('auth:api');
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/users', 'UsersController@index');
    });
});
