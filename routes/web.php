<?php

use MvcBlog\App\Controllers\MainController;

return [
    'GET' => [
        '/' => [MainController::class, 'index'],
        '/login' => [MainController::class, 'login'],
        '/registration' => [MainController::class, 'registration'],
        '/logout' => [MainController::class, 'logout'],
        '/admin' => [MainController::class, 'admin'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
        '/create-user' => [MainController::class, 'createUser'],
        '/login' => [MainController::class, 'auth'],
    ]
];
