<?php

namespace MvcBlog\App\Controllers;

abstract class ApiController
{
    public static function setHeader(): void
    {
        header('Content-Type: application/json; charset=utf-8');
    }
}