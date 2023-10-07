<?php

return [
    'GET' => [
        '/' => [MainController::class, 'index'],
    ],
    'POST' => [
        '/' => [MainController::class, 'test'],
    ]
];