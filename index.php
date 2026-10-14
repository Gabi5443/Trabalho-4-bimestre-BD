<?php

// 1. Inicia a sessão para controle de Login e Usuários
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conexão com o Banco de Dados
require_once 'conection.php';

// 3. Importação das Models
require_once 'models/AccountModel.php';
require_once 'models/ClientModel.php';
require_once 'models/WorkerModel.php';
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';

// 4. Importação das Controllers
require_once 'controllers/AccountController.php';
require_once 'controllers/ClientController.php';
require_once 'controllers/WorkerController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/ProfileController.php'; // Adicionada a ProfileController

// 5. Captura e limpa a URL amigável
// Exemplo de URL: index.php?url=profile/edit ou product/delete/5
$url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];

$recurso = isset($url[0]) ? strtolower($url[0]) : 'dashboard'; // Rota padrão se a URL for vazia
$acao    = isset($url[1]) ? strtolower($url[1]) : 'index';     // Ação padrão
$param   = isset($url[2]) ? $url[2] : null;                     // ID ou parâmetro adicional

// 6. Roteamento do Sistema
switch ($recurso) {
    
    // Rota de Produtos
    case 'product':
        $controller = new ProductController($conn);
        $controller->handleRequest($acao, $param);
        break;

    // Rota de Perfil do Usuário
    case 'profile':
        $controller = new ProfileController($conn);
        $controller->handleRequest($acao);
        break;

    // Rota de Categorias
    case 'category':
        $controller = new CategoryController($conn);
        $controller->handleRequest($acao, $param);
        break;

    // Rota de Clientes
    case 'client':
        $controller = new ClientController($conn);
        $controller->handleRequest($acao, $param);
        break;

    // Rota de Funcionários
    case 'worker':
        $controller = new WorkerController($conn);
        $controller->handleRequest($acao, $param);
        break;

    // Rota do Dashboard / Home do Funcionário
    case 'dashboard':
        $controller = new WorkerController($conn);
        $controller->handleRequest('dashboard');
        break;

    // Rota Padrão (Página não encontrada 404)
    default:
        http_response_code(404);
        echo "<h1>Erro 404 - Página não encontrada</h1>";
        echo "<p><a href='index.php?url=dashboard'>Voltar ao início</a></p>";
        break;
}
