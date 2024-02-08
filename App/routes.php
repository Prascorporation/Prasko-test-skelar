<?php
//to add your route use format: route url => controller@action, middleware, request type
return  [
    '/users' => ['UserController@index', 'authentificate', 'GET'],
    '/user/([^/]+)' => ['UserController@show', 'authentificate', 'GET'],
    '/auth/login' => ['AuthController@login', 'no_middleware', 'POST'],
    '/auth/logout' => ['AuthController@logout', 'no_middleware', 'POST'],
];
