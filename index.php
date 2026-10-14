<?php

// 1. Configuração de Cabeçalhos CORS (permite requisições do Frontend/Postman)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Trata requisições prévias do navegador (Preflight OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 2. Importa a conexão com o banco de dados
require_once 'conection.php';


// 3. Importa todas as Models
require_once 'models/AccountModel.php';
require_once 'models/ClientModel.php';
require_once 'models/WorkerModel.php';
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';

// 4. Importa todas as Controllers
require_once 'controllers/AccountController.php';
require_once 'controllers/ClientController.php';
require_once 'controllers/WorkerController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';

// 5. Captura o método HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// 6. Captura e limpa a URL amigável recebida
// Exemplo de URL: /api/product/5 ou ?url=product/5
$url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];

$recurso = isset($url[0]) ? strtolower($url[0]) : null;
$id      = isset($url[1]) ? intval($url[1]) : null;

// 7. Roteamento: Redireciona para a Controller apropriada com base no recurso da URL
switch ($recurso) {
    case 'account':
        $controller = new AccountController($conn);
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

    case 'category':
        $controller = new CategoryController($conn);
        $controller->handleRequest($method, $id);
        break;

    case 'product':
        $controller = new ProductController($conn);
        $controller->handleRequest($method, $id);
        break;

    default:
        // Se tentar acessar um recurso que não existe
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(404);
        echo json_encode([
            "message" => "Endpoint não encontrado. Recursos disponíveis: account, client, worker, category, product."
        ]);
        break;
}
