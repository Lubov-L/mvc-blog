<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\MainController;
use MvcBlog\App\Controllers\NewsController;

return [
    'GET' => [
        '/login' => [MainController::class, 'login'],
        '/registration' => [MainController::class, 'registration'],
        '/logout' => [MainController::class, 'logout'],
        '/admin-panel' => [AdminPanelController::class, 'index'],
        '/' => [NewsController::class, 'index'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
        '/create-user' => [MainController::class, 'createUser'],
        '/login' => [MainController::class, 'auth'],
    ]
];
