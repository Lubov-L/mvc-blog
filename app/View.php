<?php

namespace MvcBlog\App;

class View
{
    public static function view(string $name, array $params = []): string
    {
        $path = __DIR__ . '/../views/';

        return require_once $path . $name . '.php';
    }
}