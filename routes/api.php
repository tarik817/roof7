<?php

Route::namespace('Api')->group(function () {
    Route::get('/users', 'UsersController@index');
});
