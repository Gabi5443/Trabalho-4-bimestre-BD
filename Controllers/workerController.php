<?php

require_once __DIR__ . '/../models/workerModel.php';

class WorkerController {
    private $model;

    public function __construct($db) {
        $this->model = new workerModel($db);
    }

    // CRUD da API: recebe o método HTTP
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
                        "message" => "ID do funcionário é obrigatório para atualização"
                    ], 400);
                }
                break;

            case 'DELETE':
                if ($id !== null) {
                    $this->delete($id);
                } else {
                    $this->response([
                        "message" => "ID do funcionário é obrigatório para exclusão"
                    ], 400);
                }
                break;

            default:
                $this->response([
                    "message" => "Método HTTP não permitido"
                ], 405);
        }
    }

    // Página HTML do dashboard
    public function dashboard() {
        require __DIR__ . '/../Views/Dashboard/index.php';
    }

    private function getAll() {
        $funcionarios = $this->model->listAll();
        $this->response($funcionarios, 200);
    }

    private function getById($id) {
        $funcionario = $this->model->listById($id);

        if ($funcionario) {
            $this->response($funcionario, 200);
        }

        $this->response([
            "message" => "Funcionário não encontrado"
        ], 404);
    }

    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['NAME_WORKER']) ||
            empty($data['ROLE_WORKER']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "Nome, cargo e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->create(
            $data['NAME_WORKER'],
            $data['REGISTRATION_WORKER'] ?? null,
            $data['ROLE_WORKER'],
            $data['PHOTO_WORKER'] ?? null,
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response([
                "message" => "Funcionário cadastrado com sucesso"
            ], 201);
        }

        $this->response([
            "message" => "Erro ao cadastrar funcionário"
        ], 500);
    }

    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['NAME_WORKER']) ||
            empty($data['ROLE_WORKER']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "Nome, cargo e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->alter(
            $id,
            $data['NAME_WORKER'],
            $data['REGISTRATION_WORKER'] ?? null,
            $data['ROLE_WORKER'],
            $data['PHOTO_WORKER'] ?? null,
            $data['ID_ACCOUNT_FK']
        );

        if ($sucesso) {
            $this->response([
                "message" => "Funcionário atualizado com sucesso"
            ], 200);
        }

        $this->response([
            "message" => "Erro ao atualizar funcionário"
        ], 500);
    }

    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response([
                "message" => "Funcionário deletado com sucesso"
            ], 200);
        }

        $this->response([
            "message" => "Erro ao deletar funcionário"
        ], 500);
    }

    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
?>