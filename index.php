<?php
define('BASE_URL', '/Trabalho-4-bimestre-BD/');
// Ativar erros temporariamente para testes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
require_once __DIR__ . '/Controllers/dashboardController.php';

// 4. Captura da URL de forma segura
$url = isset($_GET['url']) ? explode('/', trim($_GET['url'], '/')) : [];

$recurso = strtolower($url[0] ?? 'home');
$acao = strtolower($url[1] ?? '');
$id = $url[2] ?? null;

// 5. Captura do método HTTP
$method = strtoupper($_SERVER['REQUEST_METHOD']);



// 5. Captura do método HTTP
$method = strtoupper($_SERVER['REQUEST_METHOD']);

// 6. Roteamento
switch ($recurso) {

   case 'product':

    $controller = new ProductController($conn);
    if ($acao === 'detail' && $method === 'GET' && $id) { //se a acao (primeira parte da url) for igual a 'detail',  o método for GET e tiver um id na url
        $controller->detail($id); //a controller chama o método detail
    } 
    
    elseif  ($acao === 'list' && $method === 'GET') { //se a acao (primeira parte da url) for igual a 'list', e o método for GET 
        $controller->list(); //a controller chama o método list
    }    
    
    else{ //senão chama o método handle request da controller
        $controller->handleRequest($method, $id);
    }

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
        $controller = new dashboardController($conn);
         $controller->index();

        break;


    case 'menu':
    $controller = new ProductController($conn);
    $controller->menu();
    break;

        case 'home':
      
        require_once __DIR__ . '/Views/home.php';
        break;

         

    default:
        http_response_code(404);
        echo 'Rota não encontrada.';
        break;
}
