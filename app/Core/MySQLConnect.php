<?php

namespace MvcBlog\App\Core;

class MySQLConnect
{
    protected static ?MySQLConnect $instance = null;

    private function __construct()
    {
        $link = mysqli_connect("mysql-mvc-blog", "root", "local");

        if (!$link){
            print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
        else {
            print("Соединение установлено успешно");
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

    public function register()
    {
        // запрос в бд на запись пользователя в таблицу users
    }
}