<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\MainController;

return [
    'GET' => [
        '/' => [MainController::class, 'index'],
        '/login' => [MainController::class, 'login'],
        '/registration' => [MainController::class, 'registration'],
        '/logout' => [MainController::class, 'logout'],
        '/admin-panel' => [AdminPanelController::class, 'index'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
        '/create-user' => [MainController::class, 'createUser'],
        '/login' => [MainController::class, 'auth'],
    ]
];
