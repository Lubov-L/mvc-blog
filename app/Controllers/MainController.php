<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Core\MySQLConnect;
use MvcBlog\App\View;

class MainController
{
    public static function index(): void
    {
        View::view('app');
    }

    public static function login(): void
    {
        View::view('login');
    }

    public static function registration(): void
    {
        View::view('registration');
    }

    public static function createUser(): void
    {
        try {
            MySQLConnect::getInstance()
                ->registration($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password']);
        } catch (\Exception $exception) {
            View::view('errors', ['error' => 'Error creating user']);
            die();
        }

        View::view('app');
    }
}