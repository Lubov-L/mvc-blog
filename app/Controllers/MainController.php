<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Core\MySQLConnect;
use MvcBlog\App\Entities\User;
use MvcBlog\App\View;

class MainController
{
    public static function index(): void
    {
        View::view('app', ['title' => 'Blog']);
    }

    public static function login(): void
    {
        View::view('login', ['title' => 'Login']);
    }

    public static function registration(): void
    {
        View::view('registration', ['title' => 'Registration']);
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /');
        die();
    }


    /**
     * Регистрация пользователя
     */
    public static function createUser(): void
    {
        try {
            $user = new User();
            MySQLConnect::getInstance()
                ->registration($user->getName(), $user->getPhone(), $user->getEmail(), $user->getPassword());
        } catch (\Exception $exception) {
            View::view('errors', ['error' => 'Error creating user']);
            die();
        }
        // Редирект на страницу login
        header('Location: /login');
        die();
    }

    /**
     * Авторизация пользователя
     */
    public static function auth()
    {
        $user = MySQLConnect::getInstance()->getUser($_POST['email']);

        if (is_array($user) && password_verify($_POST['password'], $user['password'])) {
            // Запись id авторизованного пользователя в сессию
            $_SESSION['userId'] = $user['id'];
            // Редирект на главную страницу
            header('Location: /');
            die();
        }
        View::view('errors', ['error' => 'Invalid password or login']);
    }
}