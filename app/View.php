<?php

namespace MvcBlog\App;

class View
{
    public static function view(string $name, array $params = []): void
    {
        $path = __DIR__ . '/../views/';

        require_once $path . $name . '.php';
    }
}