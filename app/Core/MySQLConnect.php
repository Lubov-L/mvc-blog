<?php

namespace MvcBlog\App\Core;


use Exception;

class MySQLConnect
{
    protected static ?MySQLConnect $instance = null;

    private $connect = null;

    private function __construct()
    {
        $this->connect = mysqli_connect("mysql-mvc-blog", "root", "local");

        if (!$this->connect) {
            print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
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
    public function registration($name, $phone, $email, $password): bool
    {
        $query = 'INSERT INTO db.users (name, phone, email, `password`) 
                    VALUES (?, ?, ?, ?)';
        $statement = $this->connect->prepare($query);

        $statement->bind_param('ssss', $name, $phone, $email, $password);

        $result = $statement->execute();

        return $result;
    }
}