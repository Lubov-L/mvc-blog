<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [
        '/api/v1/users/list' => [UserApiController::class, 'list'],
    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
        '/api/v1/registration' => [UserApiController::class, 'registration'],
    ],
    'DELETE' => [
        '/api/v1/user' => [UserApiController::class, 'delete'],
    ]
];
