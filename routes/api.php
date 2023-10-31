<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [
        '/api/v1/users/list' => [UserApiController::class, 'list'],
        '/api/v1/user' => [UserApiController::class, 'show'],
    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
        '/api/v1/registration' => [UserApiController::class, 'registration'],
    ],
    'DELETE' => [
        '/api/v1/user' => [UserApiController::class, 'delete'],
    ],
    'PUT' => [
        '/api/v1/user' => [UserApiController::class, 'edit'],
    ]
];
