<?php

namespace MvcBlog\App\Controllers;

class ErrorController
{
    private static function setHeader(): void
    {
        header("HTTP/1.1 404 Not Found");
    }

    public static function notFound(): string
    {
        self::setHeader();

        return require_once __DIR__ . '/../../views/notFound.php';
    }

    public static function apiNotFound(): string
    {
        self::setHeader();

        return json_encode(['success' => false, 'error' => 'not found']);
    }
}