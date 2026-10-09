<?php

require_once 'models/ClientModel.php'; 

class ClientController {
    private $model;

    public function __construct($db) {
        $this->model = new ClientModel($db);
    }
//Funções globais -> Como o Controller vai agir a depender do que receber na url (qual código HTTP)
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
                    $this->response(["message" => "ID do cliente é obrigatório para atualização"], 400);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $this->delete($id);
                } else {
                    $this->response(["message" => "ID do cliente é obrigatório para exclusão"], 400);
                }
                break;

            default:
                $this->response(["message" => "Método HTTP não permitido"], 405);
                break;
        }
    }

    private function getAll() {
        $clientes = $this->model->listAll();
        $this->response($clientes, 200);
    }

    private function getById($id) {
        $cliente = $this->model->listById($id);
        if ($cliente) {
            $this->response($cliente, 200);
        } else {
            $this->response(["message" => "Cliente não encontrado"], 404);
        }
    }

    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);
      //Verificação -> Se os campos obrigatórios estão preenchidos

        if (empty($data['CPF_CLIENT']) || empty($data['PHONE_CLIENT']) || empty($data['ID_ACCOUNT_FK'])) {
            $this->response(["message" => "CPF, telefone e ID da conta são obrigatórios"], 400);
            return;
        }

        $sucesso = $this->model->create( // chama a função create da model
            $data['CPF_CLIENT'],
            $data['PHONE_CLIENT'],
            $data['ADDRESS_CLIENT'] ?? '',
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response(["message" => "Cliente cadastrado com sucesso"], 201);
        } else {
            $this->response(["message" => "Erro ao cadastrar cliente"], 500);
        }
    }

    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
       //Verificação -> Se os campos obrigatórios estão preenchidos

        if (empty($data['CPF_CLIENT']) || empty($data['PHONE_CLIENT']) || empty($data['ID_ACCOUNT_FK'])) {
            $this->response(["message" => "Campos obrigatórios ausentes"], 400);
            return;
        }

        $sucesso = $this->model->alter(
            $id,
            $data['CPF_CLIENT'],
            $data['PHONE_CLIENT'],
            $data['ADDRESS_CLIENT'] ?? '',
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response(["message" => "Dados do cliente atualizados com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao atualizar dados do cliente"], 500);
        }
    }

    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Cliente deletado com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar cliente"], 500);
        }
    }

    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
