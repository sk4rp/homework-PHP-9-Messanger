<?php

use App\Controller\AuthController;

require __DIR__ . '/../../vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];

switch ($requestUri) {
    case '/':
        include __DIR__ . '/welcome.php';
        break;
    case '/register':
        $controller = new AuthController();
        $controller->register();
        break;
    case '/login':
        $controller = new AuthController();
        $controller->login();
        break;
    case '/chats':
        $controller = new AuthController();
        $controller->chats();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}
