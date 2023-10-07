<?php

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$uri = explode('?', $uri)[0];

$routing = require_once '../routes/web.php';

if ($method === 'GET') {
    $routing['GET'][$uri];
} elseif ($method === 'POST') {
    $routing['POST'][$uri];
}
