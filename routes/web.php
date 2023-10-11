<?php

use MvcBlog\App\Controllers\MainController;

return [
    'GET' => [
        '/' => [MainController::class, 'index'],
        '/login' => [MainController::class, 'login'],
        '/registration' => [MainController::class, 'registration'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
        '/create-user' => [MainController::class, 'createUser'],
        '/login' => [MainController::class, 'auth']
    ]
];
