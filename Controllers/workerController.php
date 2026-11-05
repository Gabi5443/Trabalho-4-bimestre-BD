<?php

require_once __DIR__ . '/../models/workerModel.php';

class WorkerController {
    private $model;
    private $db;

    public function __construct($db) {
        $this->model = new workerModel($db);
        $this->db = $db;
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

        require_once __DIR__ . '/../Views/Dashboard/criarFuncionario.php';
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

        require_once __DIR__ . '/../Views/Dashboard/editarFuncionario.php';
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



    public function list() {

    $workers = $this->model->listAll();

    if (!$workers) {
        http_response_code(404);
        echo "Funcionários não encontrados.";
        return;
    }

    require_once __DIR__ . '/../Views/Dashboard/listarFuncionario.php';
}







public function editForm($id)
{
    $worker = $this->model->listById($id);

    if (!$worker) {
        http_response_code(404);
        echo "Funcionário não encontrado.";
        return;
    }

    require_once __DIR__ . '/../Views/Dashboard/editarFuncionario.php';



}



public function excluir($id)
{
    $sucesso = $this->model->delete($id);

    if (!$sucesso) {
        echo "Não foi possível excluir o produto.";
        return;
    }

    header('Location: ' . BASE_URL . 'worker/list');
    exit;
}



public function updateForm ($id)
{
   $worker = $this->model->listById($id); //Busca o produto que esta sendo alterado


    if (!$worker) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    } // se não achar o produt aparece essa mensagem


     // Recupera os dados enviados pelo formulário
    $nome = trim($_POST['NAME_WORKER'] ?? '');
    $role = trim($_POST['ROLE_WORKER'] ?? '');
    $registration = $_POST['REGISTRATION_WORKER'] ?? '';
    $idAccount = $_POST['ID_ACCOUNT_FK'] ?? '';


 
    

    // Mantém a foto atual caso nenhuma nova seja enviada
    $foto = $worker['PHOTO_WORKER'];

    // Verifica se foi enviada uma nova imagem
    if (
        isset($_FILES['PHOTO_WORKER']) &&
        $_FILES['PHOTO_WORKER']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['PHOTO_WORKER']['error'] !== UPLOAD_ERR_OK) {
            echo "Erro ao enviar a imagem.";
            return;
        }

        // Verifica se o arquivo é uma imagem
        $imagem = getimagesize($_FILES['PHOTO_WORKER']['tmp_name']);

        if ($imagem === false) {
            echo "O arquivo enviado não é uma imagem válida.";
            return;
        }

        // Define o nome e o destino da imagem
        $extensao = strtolower(pathinfo(
            $_FILES['PHOTO_WORKER']['name'],
            PATHINFO_EXTENSION
        ));

        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
            echo "Formato de imagem não permitido.";
            return;
        }

        $nomeArquivo = uniqid() . '.' . $extensao;

        $diretorio = __DIR__ . '/../uploads';

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        if (!move_uploaded_file(
            $_FILES['PHOTO_WORKER']['tmp_name'],
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
        $registration,
        $role,
        $foto,
        $idAccount
        
    );

    if ($sucesso) {
        header('Location: ' . BASE_URL . 'worker/list');
        exit;
    } else {
        echo "Não foi possível atualizar o Funcionário";


}
}




public function createForm()
{
    require_once __DIR__ . '/../Views/Dashboard/criarFuncionario.php';
}

public function createFormSubmit()
{
   
    $nome = trim($_POST['NAME_WORKER'] ?? '');
    $role = trim($_POST['ROLE_WORKER'] ?? '');
    $registration = $_POST['REGISTRATION_WORKER'] ?? '';
    $idAccount = $_POST['ID_ACCOUNT_FK'] ?? '';

    // A foto será recebida por $_FILES, não por $_POST.

    $photo = null;

if (isset($_FILES['PHOTO_WORKER']) &&
    $_FILES['PHOTO_WORKER']['error'] === UPLOAD_ERR_OK) {

    $nomeArquivo = uniqid() . '_' . basename($_FILES['PHOTO_WORKER']['name']);

    $diretorio = __DIR__ . '/../uploads/';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    if (move_uploaded_file(
        $_FILES['PHOTO_WORKER']['tmp_name'],
        $diretorio . $nomeArquivo
    )) {
        $photo = 'uploads/' . $nomeArquivo;
    }
}

     


    $this->db->begin_transaction();

    $sucesso = $this->model->create(
       
        $nome,
        $registration,
        $role,
        $photo,
        $idAccount
    );

    if ($sucesso) {

     $_SESSION['mensagem'] = 'Produto criado com sucesso!';

        $this->db->commit();

        header('Location: ' . BASE_URL . 'worker/list');
        exit;
    }

    $this->db->rollback();

    echo "Erro ao cadastrar produto.";
}















    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
?>