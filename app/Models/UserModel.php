<?php

namespace MvcBlog\App\Models;

use Exception;
use MvcBlog\App\Entities\UserEntity;
use PDO;

class UserModel extends Model
{
    /**
     * @throws Exception
     */
    public function registration($name, $phone, $email, $password): void
    {
        $query = $this->pdo->prepare('INSERT INTO users (name, phone, email, `password`) 
                    VALUES (:name, :phone, :email, :password)');

        $query->execute(['name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
    }

    public function getUser($email): ?UserEntity
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }

        return new UserEntity($result);
    }

    public function getRoleName(int $userId): string
    {
        $stmt = $this->pdo->prepare('SELECT roles.name FROM users
                                            JOIN user_roles ON users.id = user_roles.user_id
                                            JOIN roles ON user_roles.role_id = roles.id
                                            WHERE users.id = :userId');
        $stmt->execute(['userId' => $userId]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return 'guest';
        }

        return $result['name'];
    }
}