<?php

namespace MvcBlog\App\Controllers;

use Exception;
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

    public static function registration(): false|string
    {
        self::setHeader();

        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $userData = new UserEntity($requestData);
        $errors = [];

        if (empty($userData->getName())) {
            $errors[] = ['field' => 'name', 'error' => 'Field is required'];
        }

        if (empty($userData->getEmail())) {
            $errors[] = ['field' => 'email', 'error' => 'Field is required'];
        }

        if (empty($userData->getPassword())) {
            $errors[] = ['field' => 'password', 'error' => 'Field is required'];
        }

        if (empty($requestData['password2'])) {
            $errors[] = ['field' => 'password2', 'error' => 'Field is required'];
        }

        if (isset($requestData['password2']) && ($userData->getPassword() !== $requestData['password2'])) {
            $errors[] = ['field' => 'password2', 'error' => 'Passwords don\'t match'];
        }

        $userModel = new UserModel();
        $user = $userModel->getUser($userData->getEmail());

        if ($user !== null) {
            $errors[] = ['field' => 'email', 'error' => 'Email is already exist'];
        }

        if (!empty($errors)) {
            return json_encode(['success' => false, 'errors' => $errors]);
        }

        $passwordHash = password_hash($userData->getPassword(), PASSWORD_DEFAULT);

        try {
            $userModel->registration($userData->getName(), $userData->getPhone(), $userData->getEmail(), $passwordHash);
        } catch (Exception) {
            return json_encode(['success' => false, 'error' => 'Error creating user']);
        }

        return json_encode(['success' => true]);
    }

    public static function list(): false|string
    {
        self::setHeader();

        $limit = 10;
        $page = (int)($_GET['page'] ?? 1);
        $offset = $limit * ($page - 1);

        $userModel = new UserModel();
        $users = $userModel->list($limit, $offset);

        $data = [
            'users' => $users,
            'page' => $page,
            'count' => $userModel->usersCount(),
            'countPage' => (int)ceil($userModel->usersCount() / $limit)
        ];

        return json_encode($data);
    }

    public static function delete(): false|string
    {
        self::setHeader();

        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $userId = $requestData["id"];
        $userModel = new UserModel();

        $result = $userModel->delete($userId);

        return json_encode(['success' => $result]);
    }

    public static function show(): false|string
    {
        self::setHeader();

        $userId = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($userId === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $userModel = new UserModel();

        $user = $userModel->show($userId);

        if ($user === false) {
            return json_encode(['success' => false, 'error' => 'User not found']);
        }

        return json_encode(['success' => true, 'user' => $user]);
    }

    public static function edit(): false|string
    {
        self::setHeader();

        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $userId = $requestData["id"];
        $userName = $requestData["name"];
        $userPhone = $requestData["phone"];
        $userEmail = $requestData["email"];
        $userModel = new UserModel();

        return $userModel->edit($userId, $userName, $userPhone, $userEmail);
    }
}