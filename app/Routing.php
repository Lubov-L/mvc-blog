<?php

namespace MvcBlog\App;

use MvcBlog\App\Controllers\ErrorController;

class Routing
{
    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $path = explode('?', $uri)[0] ?? null;

        $routing = require_once '../routes/web.php';

        $class = $routing[$method][$path][0] ?? null;
        $method = $routing[$method][$path][1] ?? null;

        if (is_null($path) || is_null($method) || is_null($class)) {
            ErrorController::notFound();
            die();
        }

        $class::$method();
    }
}