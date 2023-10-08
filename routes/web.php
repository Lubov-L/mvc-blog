<?php

use MvcBlog\App\Controllers\MainController;

return [
    'GET' => [
        '/' => [MainController::class, 'index'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
    ]
];
