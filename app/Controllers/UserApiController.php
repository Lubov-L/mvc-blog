<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Entities\UserEntity;
use MvcBlog\App\Models\UserModel;

class UserApiController extends ApiController
{
    public static function auth(): string
    {
        self::setHeader();

        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $user = new UserEntity($requestData);

        if (empty($user->getEmail()) || empty($user->getPassword())) {
            return json_encode(['success' => false, 'error' => 'Email and password are required']);
        }

        $email = $user->getEmail();
        $password = $user->getPassword();

        $userModel = new UserModel();
        $user = $userModel->getUser($email);

        if ($user === null) {
            return json_encode(['success' => false, 'error' => 'User not found']);
        }

        if (password_verify($password, $user->getPassword())) {
            // Запись id авторизованного пользователя в сессию
            $_SESSION['userId'] = $user->getId();
            $_SESSION['role'] = $userModel->getRoleName($user->getId());

            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false, 'error' => 'Invalid login or password']);
    }
}