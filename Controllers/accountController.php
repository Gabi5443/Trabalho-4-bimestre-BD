<?php

require_once 'models/AccountModel.php';

class AccountController {
    private $model;

    public function __construct($db) {
        $this->model = new AccountModel($db);
    }

    // Método central que identifica o verbo HTTP e redireciona
    public function handleRequest($method, $id = null) {
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

    // 1. GET /account
    private function getAll() {
        $contas = $this->model->listAll();
        $this->response($contas, 200);
    }

    // 2. GET /account/{id}
    private function getById($id) {
        $conta = $this->model->listById($id);
        if ($conta) {
            $this->response($conta, 200);
        } else {
            $this->response(["message" => "Conta não encontrada"], 404);
        }
    }

    // 3. POST /account
    private function create() {
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
    private function update($id) {
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
    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Conta deletada com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar conta"], 500);
        }
    }

    // Padronização da resposta JSON e HTTP Status
    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
