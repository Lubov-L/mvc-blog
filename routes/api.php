<?php

use MvcBlog\App\Controllers\UserApiController;

return [
    'GET' => [

    ],
    'POST' => [
        '/api/v1/login' => [UserApiController::class, 'auth'],
    ]
];