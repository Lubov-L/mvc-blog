<?php

namespace MvcBlog\App\Controllers;

class MainController
{
    public static function index(): void
    {
        require_once __DIR__ . '/../../views/app.php';
    }
}