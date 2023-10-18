<?php

namespace MvcBlog\App\Controllers;

class UserApiController extends ApiController
{
    public static function auth(): void
    {
        self::setHeader();

        echo json_encode([]);
    }
}