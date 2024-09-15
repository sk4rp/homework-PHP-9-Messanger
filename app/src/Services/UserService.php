<?php

namespace App\Services;

use App\Database;
use PDO;

class UserService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getPdo();
    }

    public function register($email, $password): bool
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->prepare("INSERT INTO users (email, password) VALUES (?, ?)")->execute([$email, $passwordHash]);
    }

    public function authenticate($email, $password): bool
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user && password_verify($password, $user['password']);
    }

}