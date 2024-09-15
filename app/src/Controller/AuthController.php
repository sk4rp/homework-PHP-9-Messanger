<?php

namespace App\Controller;

use App\Services\UserService;

require __DIR__ . '/../../../vendor/autoload.php';


class AuthController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->userService->register($email, $password)) {
                header('Location: /login');
            }
            echo "Registration failed";
        }
        include __DIR__ . '/../../templates/register.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->userService->authenticate($email, $password)) {
                session_start();
                $_SESSION['email'] = $email;
                header('Location: /chats');
                exit();
            }

            header('Location: /login');
        } else {
            include __DIR__ . '/../../templates/login.php';
        }
    }

    public function chats(): void
    {
        session_start();
        if (!isset($_SESSION['email'])) {
            header('Location: /login');
            exit();
        }
        include __DIR__ . '/../../templates/chats.php';
    }
}