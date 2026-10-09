<?php

require_once 'models/CategoryModel.php';

class CategoryController {
    private $model;

    public function __construct($db) {
        $this->model = new CategoryModel($db);
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
                    $this->response(["message" => "ID da categoria é obrigatório para atualização"], 400);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $this->delete($id);
                } else {
                    $this->response(["message" => "ID da categoria é obrigatório para exclusão"], 400);
                }
                break;

            default:
                $this->response(["message" => "Método HTTP não permitido"], 405);
                break;
        }
    }

    private function getAll() {
        $categorias = $this->model->listAll();
        $this->response($categorias, 200);
    }

    private function getById($id) {
        $categoria = $this->model->listById($id);
        if ($categoria) {
            $this->response($categoria, 200);
        } else {
            $this->response(["message" => "Categoria não encontrada"], 404);
        }
    }

    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['NAME_CATEGORY'])) {
            $this->response(["message" => "Nome da categoria é obrigatório"], 400);
            return;
        }

        $sucesso = $this->model->create(
            $data['NAME_CATEGORY'],
            $data['DESCRIPTION_CATEGORY'] ?? ''
        );

        if ($sucesso) {
            $this->response(["message" => "Categoria criada com sucesso"], 201);
        } else {
            $this->response(["message" => "Erro ao criar categoria"], 500);
        }
    }

    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['NAME_CATEGORY'])) {
            $this->response(["message" => "Nome da categoria é obrigatório"], 400);
            return;
        }

        $sucesso = $this->model->alter(
            $id,
            $data['NAME_CATEGORY'],
            $data['DESCRIPTION_CATEGORY'] ?? ''
        );

        if ($sucesso) {
            $this->response(["message" => "Categoria atualizada com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao atualizar categoria"], 500);
        }
    }

    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Categoria deletada com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar categoria"], 500);
        }
    }

    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
