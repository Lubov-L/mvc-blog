<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Core\MySQLConnect;
use MvcBlog\App\View;

class MainController
{
    public static function index(): void
    {
//        View::view('app');
        MySQLConnect::getInstance();
    }

    public static function login(): void
    {
        View::view('login');
    }

    public static function registration(): void
    {
        View::view('registration');
    }
}