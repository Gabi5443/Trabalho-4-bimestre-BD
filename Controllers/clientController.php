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



public function updateForm ($id)
{
   $client = $this->model->listById($id); //Busca o produto que esta sendo alterado


    if (!$client) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    } // se não achar o produt aparece essa mensagem


     // Recupera os dados enviados pelo formulário
    $nome = trim($_POST['NAME_CLIENT'] ?? '');
    $cpf = trim($_POST['CPF_CLIENT'] ?? '');
    $number = $_POST['NUMBER_CLIENT'] ?? '';
    $account = $_POST['ID_ACCOUNT_FK'] ?? '';



    // Mantém a foto atual caso nenhuma nova seja enviada
    $foto = $client['PHOTO_CLIENT'];

    // Verifica se foi enviada uma nova imagem
    if (
        isset($_FILES['']) &&
        $_FILES['PHOTO_CLIENT']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['PHOTO_CLIENT']['error'] !== UPLOAD_ERR_OK) {
            echo "Erro ao enviar a imagem.";
            return;
        }

        // Verifica se o arquivo é uma imagem
        $imagem = getimagesize($_FILES['PHOTO_CLIENT']['tmp_name']);

        if ($imagem === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            return;
        }

        // Define o nome e o destino da imagem
        $extensao = strtolower(pathinfo(
            $_FILES['PHOTO_PRODUCT']['name'],
            PATHINFO_EXTENSION
        ));

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo "Formato de imagem não permitido.";
            return;
        }

        $nomeArquivo = uniqid() . '.' . $extensao;

        $diretorio = __DIR__ . '/../assets/images/products/';

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

    // Atualiza o produto na Model
    $sucesso = $this->model->alter(
        $id,
        $nome,
        $cpf,
        $foto,
        $number,
        $account
        
       
    );

    if ($sucesso) {
        header('Location: ' . BASE_URL . 'client/list');
        exit;
    } else {
        echo "Não foi possível atualizar o produto.";
    }


}


public function createForm()
{
    require_once __DIR__ . '/../Views/Dashboard/criarCliente.php';
}

public function createFormSubmit()
{

{
    require_once __DIR__ . '/../Views/Dashboard/listarClientes.php';
}
   
    $nome = trim($_POST['NAME_CLIENT'] ?? '');
    $cpf = trim($_POST['CPF_CLIENT'] ?? '');
    $number = $_POST['NUMBER_CLIENT'] ?? '';
    $id = $_POST['ID_ACCOUNT_FK'] ?? '';
    

    // A foto será recebida por $_FILES, não por $_POST.

    $photo = null;

if (isset($_FILES['PHOTO_CLIENT']) &&
    $_FILES['PHOTO_CLIENT']['error'] === UPLOAD_ERR_OK) {

    $nomeArquivo = uniqid() . '_' . basename($_FILES['PHOTO_CLIENT']['name']);

    $diretorio = __DIR__ . '/../uploads';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    if (move_uploaded_file(
        $_FILES['PHOTO_CLIENT']['tmp_name'],
        $diretorio . $nomeArquivo
    )) {
        $photo = 'uploads/' . $nomeArquivo;
    }
}

     

    $this->db->begin_transaction();

    $sucesso = $this->model->create(
        $nome,
        $cpf,
        $number,
        $photo,
        $id
       
    );

    if ($sucesso) {

     $_SESSION['mensagem'] = 'Produto criado com sucesso!';

        $this->db->commit();

        header('Location: ' . BASE_URL . 'client/list');
        exit;
    }

    $this->db->rollback();

    echo "Erro ao cadastrar produto.";
}



















    // Padroniza as respostas JSON
    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}