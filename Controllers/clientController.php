<?php

require_once __DIR__ . '/../models/ClientModel.php';

class ClientController {
    private $model;
    private $db;


    public function __construct($db) {
        $this->model = new ClientModel($db);
         $this->db = $db;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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


    

    // POST: cadastra um cliente (Alinhado com os 5 parâmetros do Model)
    private function create() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['NAME_CLIENT']) ||
            empty($data['CPF_CLIENT']) ||
            empty($data['NUMBER_CLIENT']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "Nome, CPF, telefone e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->create(
            $data['NAME_CLIENT'],
            $data['CPF_CLIENT'],
            $data['NUMBER_CLIENT'],
            $data['PHOTO_CLIENT'] ?? null,
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

    // PUT: atualiza os dados de um cliente (Alinhado com os 6 parâmetros do Model)
    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($data) ||
            empty($data['NAME_CLIENT']) ||
            empty($data['CPF_CLIENT']) ||
            empty($data['NUMBER_CLIENT']) ||
            empty($data['ID_ACCOUNT_FK'])
        ) {
            $this->response([
                "message" => "Nome, CPF, telefone e ID da conta são obrigatórios"
            ], 400);
        }

        $sucesso = $this->model->alter(
            $id,
            $data['NAME_CLIENT'],
            $data['CPF_CLIENT'],
            $data['NUMBER_CLIENT'],
            $data['PHOTO_CLIENT'] ?? null,
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



    public function list() {

    $clients = $this->model->listAll();

    if (!$clients) {
        http_response_code(404);
        echo "Clientes não encontrados.";
        return;
    }


    require_once __DIR__ . '/../Views/Dashboard/listarClientes.php';
}


public function excluir($id)
{
    $sucesso = $this->model->delete($id);

    if (!$sucesso) {
        echo "Não foi possível excluir o produto.";
        return;
    }

    header('Location: ' . BASE_URL . 'client/list');
    exit;
}


public function editForm($id)
{
    $produto = $this->model->listById($id);

    if (!$produto) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    }

    require_once __DIR__ . '/../Views/Dashboard/editarClientes.php';



}




public function updateForm($id)
{
    $client = $this->model->listById($id);

    if (!$client) {
        http_response_code(404);
        echo "Cliente não encontrado.";
        return;
    }

    $nome = trim($_POST['NAME_CLIENT'] ?? '');
    $cpf = trim($_POST['CPF_CLIENT'] ?? '');
    $number = trim($_POST['NUMBER_CLIENT'] ?? '');
    $account = $_POST['ID_ACCOUNT_FK'] ?? '';

    // Mantém a foto atual
    $foto = $client['PHOTO_CLIENT'];

    if (
        isset($_FILES['PHOTO_CLIENT']) &&
        $_FILES['PHOTO_CLIENT']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['PHOTO_CLIENT']['error'] !== UPLOAD_ERR_OK) {
            echo "Erro ao enviar a imagem.";
            return;
        }

        $imagem = getimagesize($_FILES['PHOTO_CLIENT']['tmp_name']);

        if ($imagem === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            return;
        }

        $extensao = strtolower(pathinfo(
            $_FILES['PHOTO_CLIENT']['name'],
            PATHINFO_EXTENSION
        ));

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo "Formato de imagem não permitido.";
            return;
        }

        $nomeArquivo = uniqid() . '.' . $extensao;

        $diretorio = __DIR__ . '/../uploads/';

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        if (!move_uploaded_file(
            $_FILES['PHOTO_CLIENT']['tmp_name'],
            $diretorio . $nomeArquivo
        )) {
            echo "Não foi possível salvar a imagem.";
            return;
        }

        $foto = 'uploads/' . $nomeArquivo;
    }

    $sucesso = $this->model->alter(
        $id,
        $nome,
        $cpf,
        $number,
        $foto,
        $account
    );

    if ($sucesso) {
        header('Location: ' . BASE_URL . 'client/list');
        exit;
    }
   

    echo "Não foi possível atualizar o cliente.";
}


public function createForm()
{
    require_once __DIR__ . '/../Views/Dashboard/criarCliente.php';
}


public function createFormSubmit()
{
    $nome = trim($_POST['NAME_CLIENT'] ?? '');
    $cpf = trim($_POST['CPF_CLIENT'] ?? '');
    $number = trim($_POST['NUMBER_CLIENT'] ?? '');
    $id = $_POST['ID_ACCOUNT_FK'] ?? '';

    if ($nome === '' || $cpf === '' || $number === '' ) {
        echo "Preencha todos os campos obrigatórios.";
        return;
    }

    $photo = null;

    if (
        isset($_FILES['PHOTO_CLIENT']) &&
        $_FILES['PHOTO_CLIENT']['error'] === UPLOAD_ERR_OK
    ) {
        $imagem = getimagesize($_FILES['PHOTO_CLIENT']['tmp_name']);

        if ($imagem === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            return;
        }

        $extensao = strtolower(pathinfo(
            $_FILES['PHOTO_CLIENT']['name'],
            PATHINFO_EXTENSION
        ));

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo "Formato de imagem não permitido.";
            return;
        }

        $nomeArquivo = uniqid() . '.' . $extensao;

        $diretorio = __DIR__ . '/../uploads/';

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        if (!move_uploaded_file(
            $_FILES['PHOTO_CLIENT']['tmp_name'],
            $diretorio . $nomeArquivo
        )) {
            echo "Erro ao salvar a imagem.";
            return;
        }

        $photo = 'uploads/' . $nomeArquivo;
    }

    $this->db->begin_transaction();

    try {
        $sucesso = $this->model->create(
            $nome,
            $cpf,
            $number,
            $photo,
            $id
        );

        if (!$sucesso) {
            throw new Exception("Erro ao cadastrar cliente.");
        }

        $this->db->commit();

        $_SESSION['mensagem'] = 'Cliente criado com sucesso!';

        header('Location: ' . BASE_URL . 'client/list');
        exit;

    } catch (Throwable $e) {

        $this->db->rollback();

        echo "Erro ao cadastrar cliente: " . $e->getMessage();
    }
}














    // Padroniza as respostas JSON
    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}