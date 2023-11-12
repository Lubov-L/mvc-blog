<?php

namespace MvcBlog\App;

use MvcBlog\App\Controllers\ErrorController;
use MvcBlog\App\Enum\Role;

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
        $accessRole = $routing[$method][$path][2] ?? 'guest';
        $method = $routing[$method][$path][1] ?? null;


        if (is_null($path) || is_null($method) || is_null($class)) {
            if (str_contains($uri, '/api')) {
                echo ErrorController::apiNotFound();
            } else {
                ErrorController::notFound();
            }
            die();
        }

        if (!method_exists($class, $method)) {
            if (str_contains($uri, '/api')) {
                echo ErrorController::apiNotFound();
            } else {
                ErrorController::notFound();
            }
            die();
        }

        $_SESSION['role'] ??= 'guest';

        if ($accessRole === Role::ADMIN->value && $_SESSION['role'] !== Role::ADMIN->value) {
            http_response_code(403);
            return;
        }

        if (str_contains($uri, '/api')) {
            echo $class::$method();
        } else {
            $class::$method();
        }
    }
}