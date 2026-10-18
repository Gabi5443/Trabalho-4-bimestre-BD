<?php

require_once '../models/AccountModel.php';
require_once '../conection.php';


class AccountController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new AccountModel($db);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Método central que identifica o verbo HTTP e redireciona
    public function handleRequest($method, $id = null)
    {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $this->getById($id);
                } else {
                    $this->getAll();
                }
                break;

            case 'POST':
                $this->create();
                break;

            case 'PUT':
                if ($id) {
                    $this->update($id);
                } else {
                    $this->response(["message" => "ID da conta é obrigatório para atualização"], 400);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $this->delete($id);
                } else {
                    $this->response(["message" => "ID da conta é obrigatório para exclusão"], 400);
                }
                break;

            default:
                $this->response(["message" => "Método HTTP não permitido"], 405);
                break;
        }
    }

//metodo post (html)
//----------------------------------------------
    public function createForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $adminCode = trim($_POST['admin_code'] ?? '');

            if (empty($name) || empty($email) || empty($password)) {
                header('Location: ../Views/create.php?erro=1');
                exit;
            }

            // Defina aqui a senha universal secreta de funcionário/admin
            $senhaUniversalFuncionario = "agoraummico";

            // Se o código inserido for igual à senha universal, define como WORKER, senão CLIENT
            $type = (!empty($adminCode) && $adminCode === $senhaUniversalFuncionario) ? 'WORKER' : 'CLIENT';

            $senhaCriptografada = password_hash($password, PASSWORD_DEFAULT);

            $sucesso = $this->model->create($name, $email, $senhaCriptografada, $type);

            if ($sucesso) {
                header('Location: ../Views/login.php?sucesso=1');
                exit;
            } else {
                header('Location: ../Views/create.php?erro=1');
                exit;
            }
        }
    }

    // 2. Processa o login vindo do formulário HTML e faz o redirecionamento por tipo
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            // Precisamos garantir que o AccountModel tenha o método findByEmail
            // Caso não tenha no seu AccountModel atual, adicione-o (mostrado abaixo)
            $usuario = $this->model->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario['PASSWORD_ACCOUNT'])) {
                $_SESSION['id_account'] = $usuario['ID_ACCOUNT'];
                $_SESSION['name_account'] = $usuario['NAME_ACCOUNT'];
                $_SESSION['type_account'] = $usuario['TYPE_ACCOUNT'];

                // Redirecionamento obrigatório baseado no tipo de conta
                if ($usuario['TYPE_ACCOUNT'] === 'WORKER') {
                    header('Location: ../Views/dashboard_adm.php');
                    exit;
                } else {
                    header('Location: ../Views/menu.php');
                    exit;
                }
            } else {
                header('Location: ../Views/login.php?erro=1');
                exit;
            }
        }
    }

    // 3. Termina a sessão
    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header('Location: ../views/login.php');
        exit;
    }
    //------------------------------------------------

    // 1. GET /account
    private function getAll()
    {
        $contas = $this->model->listAll();
        $this->response($contas, 200);
    }

    // 2. GET /account/{id}
    private function getById($id)
    {
        $conta = $this->model->listById($id);
        if ($conta) {
            $this->response($conta, 200);
        } else {
            $this->response(["message" => "Conta não encontrada"], 404);
        }
    }

    // 3. POST /account
    private function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validação básica dos campos obrigatórios
        if (
            empty($data['NAME_ACCOUNT']) ||
            empty($data['EMAIL_ACCOUNT']) ||
            empty($data['PASSWORD_ACCOUNT'])
        ) {
            $this->response(["message" => "Nome, e-mail e senha são obrigatórios"], 400);
            return;
        }

        // Criptografia da senha antes de enviar para a Model
        //Para isso, a senha é transformada em um hash. hash é como a impressão digital de um arquivo que transforma uma informação de qualquer tamanho em uma sequência de caracteres com tamanho fixo.

        $senhaCriptografada = password_hash($data['PASSWORD_ACCOUNT'], PASSWORD_DEFAULT); // Cria um hash a partir da senha

        $sucesso = $this->model->create( //chama a função create da model
            $data['NAME_ACCOUNT'],
            $data['EMAIL_ACCOUNT'],
            $senhaCriptografada,
            $data['TYPE_ACCOUNT'] ?? 'CLIENT' // Tipo padrão se não for informado
        );

        if ($sucesso) {
            $this->response(["message" => "Conta criada com sucesso"], 201);
        } else {
            $this->response(["message" => "Erro ao criar conta"], 500);
        }
    }

    // 4. PUT /account/{id}
    private function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            empty($data['NAME_ACCOUNT']) ||
            empty($data['EMAIL_ACCOUNT'])
        ) {
            $this->response(["message" => "Nome e e-mail são obrigatórios para atualização"], 400);
            return;
        }

        // Se uma nova senha for informada no JSON, criptografa a nova senha
        // Se a senha vier vazia, mantém a lógica de atualização sem alterar a senha
        $senhaFinal = null;
        if (!empty($data['PASSWORD_ACCOUNT'])) {
            $senhaFinal = password_hash($data['PASSWORD_ACCOUNT'], PASSWORD_DEFAULT);
        }

        $sucesso = $this->model->alter(
            $id,
            $data['NAME_ACCOUNT'],
            $data['EMAIL_ACCOUNT'],
            $senhaFinal,
            $data['TYPE_ACCOUNT'] ?? 'CLIENT'
        );

        if ($sucesso) {
            $this->response(["message" => "Conta atualizada com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao atualizar conta"], 500);
        }
    }

    // 5. DELETE /account/{id}
    private function delete($id)
    {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Conta deletada com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar conta"], 500);
        }
    }

    // Padronização da resposta JSON e HTTP Status
    private function response($data, $statusCode = 200)
    {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}


// Cria o controller fora da classe
$controller = new AccountController($db);

// Identifica a ação solicitada na URL
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $controller->createForm();
        break;

    case 'login':
        $controller->login();
        break;

    case 'logout':
        $controller->logout();
        break;

    default:
        http_response_code(404);
        echo "Ação não encontrada.";
        break;
}
