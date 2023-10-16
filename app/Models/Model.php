<?php

namespace MvcBlog\App\Models;

use MvcBlog\App\Core\MySQLConnect;
use PDO;

class Model
{
    protected ?PDO $pdo = null;

    public function __construct()
    {
        $this->pdo = MySQLConnect::getInstance()->connect();
    }
}