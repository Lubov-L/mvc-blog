<?php

use MvcBlog\App\Routing;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$routing = new Routing();
$routing->run();