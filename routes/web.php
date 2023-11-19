<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\MainController;
use MvcBlog\App\Controllers\NewsController;
use MvcBlog\App\Enum\Role;

return [
    'GET' => [
        '/login' => [MainController::class, 'login'],
        '/registration' => [MainController::class, 'registration'],
        '/logout' => [MainController::class, 'logout'],
        '/admin-panel' => [AdminPanelController::class, 'index', Role::ADMIN->value],
        '/' => [NewsController::class, 'index'],
    ],
    'POST' => [
        '/create-user' => [MainController::class, 'createUser'],
        '/login' => [MainController::class, 'auth'],
    ]
];
