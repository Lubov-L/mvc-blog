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

        if (str_contains($uri, '/api')) {
            $routing = require_once '../routes/api.php';
        } else {
            $routing = require_once '../routes/web.php';
        }

        $class = $routing[$method][$path][0] ?? null;
        $method = $routing[$method][$path][1] ?? null;

        if (is_null($path) || is_null($method) || is_null($class)) {
            if (str_contains($uri, '/api')) {
                ErrorController::apiNotFound();
            } else {
                ErrorController::notFound();
            }
        }

        if (!method_exists($class, $method)) {
            ErrorController::notFound();
            die();
        }

        if (str_contains($uri, '/api')) {
            echo $class::$method();
        } else {
            $class::$method();
        }
    }
}