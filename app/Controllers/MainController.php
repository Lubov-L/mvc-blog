<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Entities\UserEntity;
use MvcBlog\App\Models\UserModel;
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

    public static function admin(): void
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            View::view('admin', ['title' => 'Admin panel']);
            die();
        }
        View::view('notFound', ['title' => 'Error']);
        die();
    }


    /**
     * Регистрация пользователя
     */
    public static function createUser(): void
    {
        try {
            $userEntity = new UserEntity();
            $user = new UserModel();

            $passwordHash = password_hash($userEntity->getPassword(), PASSWORD_DEFAULT);

            $user->registration($userEntity->getName(), $userEntity->getPhone(), $userEntity->getEmail(), $passwordHash);
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
    public static function auth(): void
    {
        $userEntity = new UserEntity();
        $userModel = new UserModel();
        $user = $userModel->getUser($userEntity->getEmail());

        if (is_null($user)) {
            View::view('errors', ['error' => 'Invalid password or login']);
            die();
        }

        if (password_verify($userEntity->getPassword(), $user->getPassword())) {

            // Запись id авторизованного пользователя в сессию
            $_SESSION['userId'] = $user->getId();
            $_SESSION['role'] = $userModel->getRoleName($user->getId());

            // Редирект на главную страницу
            header('Location: /');
            die();
        }

        View::view('errors', ['error' => 'Invalid password or login']);
    }
}