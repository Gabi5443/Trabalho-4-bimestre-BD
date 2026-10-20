
<?php

require_once __DIR__ . '/../Models/clientModel.php';

class ClientController {
    private $model;

    public function __construct($db) {
        $this->model = new ClientModel($db);
    }

    // Recebe o método HTTP e encaminha para a operação adequada
    public function handleRequest($method, $id = null) {
        switch (strtoupper($method)) {
            case 'GET':
                if ($id !== null) {
                    $this->getById($id);
                } else {
                    $this->getAll();
                }
                break;

            case 'POST':
                $this->create();
                break;

            case 'PUT':
                if ($id !== null) {
                    $this->update($id);
                } else {
                    $this->response([
                        "message" => "ID do cliente é obrigatório para atualização"
                    ], 400);
                }
                break;

            case 'DELETE':
                if ($id !== null) {
                    $this->delete($id);
                } else {
                    $this->response([
                        "message" => "ID do cliente é obrigatório para exclusão"
                    ], 400);
                }
                break;

            default:
                $this->response([
                    "message" => "Método HTTP não permitido"
                ], 405);
        }
    }

    // GET: lista todos os clientes
    private function getAll() {
        $clientes = $this->model->listAll();
        $this->response($clientes, 200);
    }

    // GET: busca um cliente pelo ID
    private function getById($id) {
        $cliente = $this->model->listById($id);

        if ($cliente) {
            $this->response($cliente, 200);
        }

        $this->response([
            "message" => "Cliente não encontrado"
        ], 404);
    }

    // POST: cadastra um cliente
    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['CPF_CLIENT']) ||
            empty($data['PHONE_CLIENT']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "CPF, telefone e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->create(
            $data['CPF_CLIENT'],
            $data['PHONE_CLIENT'],
            $data['ADDRESS_CLIENT'] ?? '',
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response([
                "message" => "Cliente cadastrado com sucesso"
            ], 201);
        }

        $this->response([
            "message" => "Erro ao cadastrar cliente"
        ], 500);
    }

    // PUT: atualiza os dados de um cliente
    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['CPF_CLIENT']) ||
            empty($data['PHONE_CLIENT']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "CPF, telefone e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->alter(
            $id,
            $data['CPF_CLIENT'],
            $data['PHONE_CLIENT'],
            $data['ADDRESS_CLIENT'] ?? '',
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response([
                "message" => "Dados do cliente atualizados com sucesso"
            ], 200);
        }

        $this->response([
            "message" => "Erro ao atualizar dados do cliente"
        ], 500);
    }

    // DELETE: exclui um cliente
    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response([
                "message" => "Cliente deletado com sucesso"
            ], 200);
        }

        $this->response([
            "message" => "Erro ao deletar cliente"
        ], 500);
    }

    // Padroniza as respostas JSON
    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
