<?php

namespace MvcBlog\App\Controllers;

class ErrorController
{
    public static function notFound(): void
    {
        require_once __DIR__ . '/../../views/notFound.php';
    }
}