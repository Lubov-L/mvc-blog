<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Core\MySQLConnect;
use MvcBlog\App\Entities\User;
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
            $user = new User();
            MySQLConnect::getInstance()
                ->registration($user->getName(), $user->getPhone(), $user->getEmail(), $user->getPassword());
        } catch (\Exception $exception) {
            View::view('errors', ['error' => 'Error creating user']);
            var_dump($exception->getMessage());
            die();
        }

        View::view('app');
    }

    public static function auth()
    {
        $user = MySQLConnect::getInstance()->getUser($_POST['email']);

        if (is_array($user) && password_verify($_POST['password'], $user['password'])) {
            View::view('app');
            die();
        }
        View::view('errors', ['error' => 'Invalid password or login']);
    }
}