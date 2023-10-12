<?php

namespace MvcBlog\App\Core;

use Exception;
use PDO;
use PDOException;

class MySQLConnect
{
    protected static ?MySQLConnect $instance = null;

    private ?PDO $pdo = null;

    private function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=mysql-mvc-blog;dbname=db", "root", "local");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function __clone()
    {
    }

    public static function getInstance(): MySQLConnect
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function registration($name, $phone, $email, $password): void
    {
        $query = $this->pdo->prepare('INSERT INTO users (name, phone, email, `password`) 
                    VALUES (:name, :phone, :email, :password)');

        $query->execute(['name'=> $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
    }

    public function getUser($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return $stmt->fetch();
    }

}