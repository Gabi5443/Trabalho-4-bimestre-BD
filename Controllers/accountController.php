<?php

require_once __DIR__ . '/../Models/accountModel.php';

class AccountController
{
    private $model;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
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

    // Método post para criação via formulário HTML
    public function createForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            
        
            if (empty($name) || empty($email) || empty($password)) {
                $erroMensagem = "Por favor, preencha todos os campos obrigatórios!";
                require_once __DIR__ . '/../Views/Login/create.php';
                return;
            }

         $dominioCorporativo = '@defufu.com.br';
         $type = str_ends_with(strtolower($email), $dominioCorporativo) ? 'WORKER' : 'CLIENT';
            $senhaCriptografada = password_hash($password, PASSWORD_DEFAULT);

            try {
                $sucesso = $this->model->create($name, $email, $senhaCriptografada, $type);

                if ($sucesso) {
                    header('Location: index.php?url=account/login&sucesso=1');
                    exit;
                } else {
                    $erroMensagem = "Ops! Não foi possível criar a conta neste momento. Tente novamente.";
                    require_once __DIR__ . '/../Views/Login/create.php';
                    return;
                }
            } catch (Exception $e) {
                $erroMensagem = "Ops! Este e-mail já está a ser utilizado. Que tal tentar entrar com ele ou usar um endereço diferente? ";
                require_once __DIR__ . '/../Views/Login/create.php';
                return;
            }
        } else {
            require_once __DIR__ . '/../Views/Login/create.php'; 
        }
    }

    // 2. Processa o login vindo do formulário HTML e guarda dados na sessão
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            if (empty($email) || empty($senha)) {
                header('Location: index.php?url=login&erro=empty');
                exit;
            }

            $usuario = $this->model->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario['PASSWORD_ACCOUNT'])) {
                // 1. Guardar os dados básicos na sessão
                $_SESSION['id_account'] = $usuario['ID_ACCOUNT'];
                $_SESSION['name_account'] = $usuario['NAME_ACCOUNT'];
                $_SESSION['type_account'] = $usuario['TYPE_ACCOUNT'];

                // 2. Buscar a foto de perfil para guardar na sessão logo no login (se for CLIENT)
             if ($usuario['TYPE_ACCOUNT'] === 'CLIENT') {
                    require_once __DIR__ . '/../Models/clientModel.php';
                    
                    // Dica para o Intelephense saber que $clientModel é uma instância de ClientModel
                    /** @var ClientModel $clientModel */
                    $clientModel = new ClientModel($this->db);
                    
                    $dadosClient = $clientModel->getProfileData($usuario['ID_ACCOUNT']);
                    $_SESSION['photo'] = $dadosClient['PHOTO_CLIENT'] ?? null;
                } else {
                    $_SESSION['photo'] = null; 
                }

                // 3. Redirecionamento baseado no tipo de conta
                if ($usuario['TYPE_ACCOUNT'] === 'WORKER') {
                    header('Location: index.php?url=dashboard');
                    exit;
                } else {
                    header('Location: index.php?url=menu');
                    exit;
                }
            } else {
                header('Location: index.php?url=login&erro=1');
                exit;
            }
        } else {
            require_once __DIR__ . '/../Views/Login/login.php'; 
        }
    }

    // 3. Termina a sessão
    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header('Location: ../Views/Login/login.php');
        exit;
    }

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

        if (
            empty($data['NAME_ACCOUNT']) ||
            empty($data['EMAIL_ACCOUNT']) ||
            empty($data['PASSWORD_ACCOUNT'])
        ) {
            $this->response(["message" => "Nome, e-mail e senha são obrigatórios"], 400);
            return;
        }

        $senhaCriptografada = password_hash($data['PASSWORD_ACCOUNT'], PASSWORD_DEFAULT);

        $sucesso = $this->model->create(
            $data['NAME_ACCOUNT'],
            $data['EMAIL_ACCOUNT'],
            $senhaCriptografada,
            $data['TYPE_ACCOUNT'] ?? 'CLIENT'
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
