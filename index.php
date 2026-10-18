
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
$acao = strtolower($url[1] ?? '');
$id = $url[2] ?? null;

// 5. Captura do método HTTP
$method = strtoupper($_SERVER['REQUEST_METHOD']);

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

        switch ($acao) {
            case 'register':
                $controller->createForm();
                break;

            case 'login':
                $controller->login();
                break;

            case 'logout':
                $controller->logout();
                break;

            default:
                $controller->handleRequest($method, $id);
                break;
        }
        break;

    case 'dashboard':
        $controller = new WorkerController($conn);

        // A página do dashboard deve ser encaminhada
        // para um método próprio da WorkerController.
        $controller->dashboard();
        break;

    default:
        http_response_code(404);
        echo 'Rota não encontrada.';
        break;
}
