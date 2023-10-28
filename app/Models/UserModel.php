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

    public function list(int $limit, int $offset = 0): array|null
    {
        $stmt = $this->pdo->prepare('SELECT name, email  FROM users LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users === false) {
            return null;
        }

        return $users;
    }

    public function usersCount()
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users');
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}