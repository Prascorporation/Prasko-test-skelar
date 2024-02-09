<?php
//to add your route use format: route url => controller@action, middleware, request type
return  [
    '/users' => ['UserController@index', 'authenticate', 'GET'],
    '/user/([^/]+)' => ['UserController@show', 'authenticate', 'GET'],
    '/auth/login' => ['AuthController@login', 'no_middleware', 'POST'],
    '/auth/logout' => ['AuthController@logout', 'no_middleware', 'POST'],
];
