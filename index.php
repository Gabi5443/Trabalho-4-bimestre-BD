
<?php

// 1. Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conexão com o banco de dados
require_once __DIR__ . '/conection.php';

// 3. Importação das Controllers
require_once __DIR__ . '/controllers/AccountController.php';
require_once __DIR__ . '/controllers/ClientController.php';
require_once __DIR__ . '/controllers/WorkerController.php';
require_once __DIR__ . '/controllers/CategoryController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/ProfileController.php';

// 4. Captura da URL
$url = isset($_GET['url'])
    ? explode('/', trim($_GET['url'], '/'))
    : [];

$recurso = strtolower($url[0] ?? 'dashboard');
$id = $url[1] ?? null;

// 5. Captura do método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// 6. Roteamento
switch ($recurso) {

    case 'product':
        $controller = new ProductController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'category':
        $controller = new CategoryController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'client':
        $controller = new ClientController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'worker':
        $controller = new WorkerController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'profile':
        $controller = new ProfileController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'account':
        $controller = new AccountController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'dashboard':
        // O dashboard é uma página HTML, não necessariamente uma API REST.
        $controller = new WorkerController($conn);
        $controller->handleRequest('dashboard');
        break;

    default:
        http_response_code(404);
        echo 'Rota não encontrada.';
        break;
}
