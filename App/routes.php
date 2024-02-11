<?php

use App\Routing\Route;

return [
    Route::get('/users', 'UserController@index')->middleware('authenticate'),
    Route::get('/user/{$userName}', 'UserController@show')->middleware('authenticate'),
    Route::post('/auth/login', 'AuthController@login'),
    Route::post('/auth/logout', 'AuthController@logout'),
];
