<?php

use MvcBlog\App\Routing;

require_once __DIR__ . '/../vendor/autoload.php';

$routing = new Routing();
$routing->run();