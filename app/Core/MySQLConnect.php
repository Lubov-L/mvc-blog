<?php

namespace MvcBlog\App\Core;

use PDO;
use PDOException;

class MySQLConnect
{
    protected static ?MySQLConnect $instance = null;

    protected ?PDO $pdo = null;

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

    public function connect(): ?PDO
    {
        return $this->pdo;
    }
}