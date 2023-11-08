<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\NewsController;
use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [
        '/api/v1/users/list' => [UserApiController::class, 'list'],
        '/api/v1/user' => [UserApiController::class, 'show'],
        '/api/v1/news/list' => [NewsController::class, 'list'],
    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
        '/api/v1/registration' => [UserApiController::class, 'registration'],
        '/api/v1/create-news' => [NewsController::class, 'create'],
    ],
    'DELETE' => [
        '/api/v1/user' => [UserApiController::class, 'delete'],
        '/api/v1/news' => [NewsController::class, 'delete'],
    ],
    'PUT' => [
        '/api/v1/user' => [UserApiController::class, 'edit'],
    ]
];
