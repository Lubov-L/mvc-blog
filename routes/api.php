<?php

use MvcBlog\App\Controllers\AdminPanelController;
use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [

    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
        '/api/v1/registration' => [UserApiController::class, 'registration'],
    ]
];
