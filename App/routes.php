<?php

use App\Routing\Route;

return [
    Route::get('/users', 'UserController@index')->middleware('AuthMiddleware'),
    Route::get('/user/{$userName}', 'UserController@show')->middleware('AuthMiddleware'),
    Route::post('/auth/login', 'AuthController@login'),
    Route::post('/auth/logout', 'AuthController@logout'),
];
