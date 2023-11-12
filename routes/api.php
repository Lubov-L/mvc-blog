<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\NewsController;
use MvcBlog\App\Controllers\UserApiController;
use MvcBlog\App\Enum\Role;

return [
    'GET' => [
        '/api/v1/users/list' => [UserApiController::class, 'list', Role::ADMIN->value],
        '/api/v1/user' => [UserApiController::class, 'show', Role::ADMIN->value],
        '/api/v1/news/list' => [NewsController::class, 'list'],
        '/api/v1/admin/stat' => [AdminPanelController::class, 'showStat', Role::ADMIN->value],
        '/api/v1/news' => [NewsController::class, 'show'],
    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
        '/api/v1/registration' => [UserApiController::class, 'registration'],
        '/api/v1/create-news' => [NewsController::class, 'create', 'admin'],
    ],
    'DELETE' => [
        '/api/v1/user' => [UserApiController::class, 'delete', Role::ADMIN->value],
        '/api/v1/news' => [NewsController::class, 'delete', Role::ADMIN->value],
    ],
    'PUT' => [
        '/api/v1/user' => [UserApiController::class, 'edit', Role::ADMIN->value],
        '/api/v1/news' => [NewsController::class, 'edit', Role::ADMIN->value],
    ]
];
