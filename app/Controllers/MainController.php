<?php

namespace MvcBlog\App\Controllers;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use MvcBlog\App\Entities\UserEntity;
use MvcBlog\App\Models\UserModel;
use MvcBlog\App\View;

class MainController
{
    public static function login(): string
    {
        return View::view('login', ['title' => 'Login']);
    }

    public static function registration(): string
    {
        return View::view('registration', ['title' => 'Registration']);
    }

    #[NoReturn]
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
    public static function createUser(): string
    {
        try {
            $userEntity = new UserEntity();
            $user = new UserModel();

            $passwordHash = password_hash($userEntity->getPassword(), PASSWORD_DEFAULT);

            $user->registration(
                $userEntity->getName(),
                $userEntity->getPhone(),
                $userEntity->getEmail(),
                $passwordHash
            );
        } catch (Exception) {
            return View::view('errors', ['error' => 'Error creating user']);
        }
        // Редирект на страницу login
        header('Location: /login');
        die();
    }
}