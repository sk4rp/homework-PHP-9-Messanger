<?php

namespace App;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}";
        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}