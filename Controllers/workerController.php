<?php

require_once 'models/WorkerModel.php';

class WorkerController {
    private $model;

    public function __construct($db) {
        $this->model = new WorkerModel($db);
    }

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
                    $this->response(["message" => "ID do funcionário é obrigatório para atualização"], 400);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $this->delete($id);
                } else {
                    $this->response(["message" => "ID do funcionário é obrigatório para exclusão"], 400);
                }
                break;

            default:
                $this->response(["message" => "Método HTTP não permitido"], 405);
                break;
        }
    }

    private function getAll() {
        $funcionarios = $this->model->listAll();
        $this->response($funcionarios, 200);
    }

    private function getById($id) {
        $funcionario = $this->model->listById($id);
        if ($funcionario) {
            $this->response($funcionario, 200);
        } else {
            $this->response(["message" => "Funcionário não encontrado"], 404);
        }
    }

    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['ROLE_WORKER']) || empty($data['ID_ACCOUNT_FK'])) {
            $this->response(["message" => "Cargo e ID da conta são obrigatórios"], 400);
            return;
        }

        $sucesso = $this->model->create(
            $data['ROLE_WORKER'],
            $data['SALARY_WORKER'] ?? 0.00,
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response(["message" => "Funcionário cadastrado com sucesso"], 201);
        } else {
            $this->response(["message" => "Erro ao cadastrar funcionário"], 500);
        }
    }

    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['ROLE_WORKER']) || empty($data['ID_ACCOUNT_FK'])) {
            $this->response(["message" => "Campos obrigatórios ausentes"], 400);
            return;
        }

        $sucesso = $this->model->alter(
            $id,
            $data['ROLE_WORKER'],
            $data['SALARY_WORKER'] ?? 0.00,
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response(["message" => "Funcionário atualizado com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao atualizar funcionário"], 500);
        }
    }

    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Funcionário deletado com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar funcionário"], 500);
        }
    }

    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
