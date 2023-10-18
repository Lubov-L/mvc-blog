<?php

use MvcBlog\App\Controllers\MainController;
use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [
        '/api/v1/login' => [UserApiController::class, 'login'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
    ]
];
