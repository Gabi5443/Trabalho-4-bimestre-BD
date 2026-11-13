<?php

require_once __DIR__ . '/../Models/productModel.php';
require_once __DIR__ . '/../Models/categoryModel.php';

class ProductController {
   private $model;
private $db;

public function __construct($db) {
    $this->db = $db;
    $this->model = new ProductModel($db);
} // quando a controller for estanciada no index, ela faz conexao com o conection.bd e estancia a product model

    // Método central que identifica a requisição
    public function handleRequest($method, $id = null) { //Lê o que o usuário manda por url (get,post,pull, delete) e decide o que vai executar
        switch ($method) { //mude para (algum dos métodos/verbos HTTPS) caso:
            case 'GET': // Se vier get pela url faça:
                if ($id) {
                    $this->getById($id); //Se vier id na url você escolhe o produto especifico
                } else {
                    $this->getAll(); // senão voce lista todo os produtos
                }
                break;

            case 'POST':
                $this->create(); // se vier POST na url, voce cria um produto
                break;

            case 'PUT':
                if ($id) {
                    $this->update($id); //se vier PUT junto do id do produto, ele atualiza o prduto
                } else {
                    $this->response(["message" => "ID do produto é obrigatório para atualização"], 400); //Se o id não vier,ele pede o id
                }
                break;

            case 'DELETE':
                if ($id) {
                    $this->delete($id); //Se vier delete junto do id do produto ele atualiza o produto
                } else {
                    $this->response(["message" => "ID do produto é obrigatório para exclusão"], 400); //Senão ele pede o id
                }
                break;

            default:
                $this->response(["message" => "Método HTTP não permitido"], 45); // Se não vier nada acima n url, ele pede um método HTTP válido
                break;
        }
    }
  
  //Modos de leitura//

    // 1. GET /produtos
    private function getAll() {
        $produtos = $this->model->listAll(); //Chama a função listAll dentro da model e coloca o resultado dentro o array variável $produtos
        $this->response($produtos, 200); // A resposta (o que essa função irá retornar) é o que esta denro da variável $produtos e o código 200 (que indica que funcionou)
    }

    // 2. GET /produtos/{id}
    private function getById($id) {
        $produto = $this->model->listById($id);  //Chama a função listByID dentro da model e coloca o resultado dentro o array variável $produto
        if ($produto) {
            $this->response($produto, 200); // SE houver um produto com aquele Id ele retorna o conteúdo da variável $produto e o código 200
        } else {
            $this->response(["message" => "Produto não encontrado"], 404); // Se não for o caso, ele retorna essa mensagem e o código 404 ("request not found")
        }
    }

    // 3. POST /produtos
    private function create() {
        // Pega os dados JSON enviados na requisição
        $data = json_decode(file_get_contents('php://input'), true);

        // Validação básica de campos obrigatórios
        //(campos marcados como not null)
        if ( // Se esses campos vierem vazios, faça:
            empty($data['NAME_PRODUCT']) || 
            empty($data['PRICE_PRODUCT']) || 
            empty($data['ID_CATEGORY_FK'])
        ) {
            $this->response(["message" => "Campos obrigatórios ausentes"], 400); //Mande essa mensagem
            return;
        }
//Senão: pega a funçao create da model e coloca dentro da variavel sucesso
        $sucesso = $this->model->create(
            $data['NAME_PRODUCT'],
            $data['DESCRIPTION_PRODUCT'] ?? '',
            $data['PRICE_PRODUCT'],
            $data['PHOTO_PRODUCT'] ?? '',
            $data['STOCK_PRODUCT'] ?? 0,
            $data['ID_CATEGORY_FK']
        );

        if ($sucesso) { // se tiver algo dentro de sucesso
            $this->response(["message" => "Produto criado com sucesso"], 201); //mostra a mensagem
        } else { //senão
            $this->response(["message" => "Erro ao criar produto"], 500); //mostra a mensagem de erro

        
        }

        require_once __DIR__ . '/../Views/Dashboard/criarProduto.php';
    }

    // 4. PUT /produtos/{id}
    private function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
//Verificação: se existe conteúdo dentro dos campos demarcado de not null
        if (
            empty($data['NAME_PRODUCT']) || 
            empty($data['PRICE_PRODUCT']) || 
            empty($data['ID_CATEGORY_FK'])
        ) {
            $this->response(["message" => "Campos obrigatórios ausentes"], 400);
            return;
        }
//chama a função de alteração da model
        $sucesso = $this->model->alter(
            $id,
            $data['NAME_PRODUCT'],
            $data['DESCRIPTION_PRODUCT'] ?? '',
            $data['PRICE_PRODUCT'],
            $data['PHOTO_PRODUCT'] ?? '',
            $data['STOCK_PRODUCT'] ?? 0,
            $data['ID_CATEGORY_FK']
        );

        if ($sucesso) {
            $this->response(["message" => "Produto atualizado com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao atualizar produto"], 500);
        }
        
    }

    // 5. DELETE /produtos/{id}
    private function delete($id) {
        $sucesso = $this->model->delete($id);

        if ($sucesso) {
            $this->response(["message" => "Produto deletado com sucesso"], 200);
        } else {
            $this->response(["message" => "Erro ao deletar produto"], 500);
        }
    }


    // TODOS OS MÉTODOS ACIMA TRABALHAM APENAS OS DADOS COMO JSON, NO NOSSO PROJETO, OS MÉTODOS DEVEM RETORNAR DADOS PARA HTML (DEVEM SER TRABALHADOS VISUALMENTE), POR ISSO, OS MÉTODOS ABAIXO CARREGAM MÉTODOS DA MODEL E RETORNAM SEUS RESULTADOS ÀS VIEWS POR MEIO DE REQUIRE ONCE



    //método para levar até a pagina de confirmação depois de pedir 

  public function pedir($id)
{
    $produto = $this->model->listById($id); // olist by id aqui se dá porque o método depende que o usuário esteja na página de detalhe de cada produto (que por sua vez possui um id próprio)

    if (!$produto) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    }

    require_once __DIR__ . '/../Views/Menu/confirmacao.php';
}



public function menu() {
    $categoryModel = new CategoryModel($this->db);

    $categorias = $categoryModel->listAll(); //$categorias recebe o método listall da model que lista todas as categorias existentes

    $produtos = $this->model->listAll(); 

    
    // $produtos recebe o método listall da model que lista todas os produtos existentes

    $produtosPorCategoria = []; // essa variavel recebe uma array vazia

    foreach ($categorias as $categoria) { // contador (para cada categoria sendo $categoria a categoria atual a ser percorrida)
        $idCategoria = $categoria['ID_CATEGORY']; // o id de cada categoria é atribuido a essa variavel
        $produtosPorCategoria[$idCategoria] = []; //a categoria de cada produto (com base em seu id) é atribuido a esse array
    }

    foreach ($produtos as $produto) { // para cada produto sendo $produto o produto a ser percorrrido
        $idCategoria = $produto['ID_CATEGORY_FK']; // atribua seu id a essa variavel

        if (isset($produtosPorCategoria[$idCategoria])) { // se existir uma array de categoria com esse id atribuido
            $produtosPorCategoria[$idCategoria][] = $produto; // o produto é adicionado ao fina dela
        }
    }

    require_once __DIR__ . '/../Views/Menu/menu.php';
}


public function detail($id) {

    $produto = $this->model->listById($id);

    if (!$produto) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    }

    require_once __DIR__ . '/../Views/Menu/detalhe.php';
}



public function list() {

    $produtos = $this->model->listAll(); 

    require_once __DIR__ . '/../Views/Dashboard/listarProdutos.php';
}


public function editForm($id)
{
     $categoryModel = new CategoryModel($this->db);
    $categorias = $categoryModel->listAll();
    $produto = $this->model->listById($id);

    if (!$produto) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    }

    require_once __DIR__ . '/../Views/Dashboard/editarProduto.php';



}



public function excluir($id)
{
    $sucesso = $this->model->delete($id);

    if (!$sucesso) {
        echo "Não foi possível excluir o produto.";
        return;
    }

    header('Location: ' . BASE_URL . 'product/list');
    exit;
}



public function updateForm ($id)
{
   $produto = $this->model->listById($id); //Busca o produto que esta sendo alterado


    if (!$produto) {
        http_response_code(404);
        echo "Produto não encontrado.";
        return;
    } // se não achar o produt aparece essa mensagem


     // Recupera os dados enviados pelo formulário
    $nome = trim($_POST['NAME_PRODUCT'] ?? '');
    $descricao = trim($_POST['DESCRIPTION_PRODUCT'] ?? '');
    $preco = $_POST['PRICE_PRODUCT'] ?? '';
    $estoque = $_POST['STOCK_PRODUCT'] ?? 0;
    $categoria = $_POST['ID_CATEGORY_FK'] ?? '';


 
    

    // Mantém a foto atual caso nenhuma nova seja enviada
    $foto = $produto['PHOTO_PRODUCT'];

    // Verifica se foi enviada uma nova imagem
    if (
        isset($_FILES['PHOTO_PRODUCT']) &&
        $_FILES['PHOTO_PRODUCT']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['PHOTO_PRODUCT']['error'] !== UPLOAD_ERR_OK) {
            echo "Erro ao enviar a imagem.";
            return;
        }

        // Verifica se o arquivo é uma imagem
        $imagem = getimagesize($_FILES['PHOTO_PRODUCT']['tmp_name']);

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
            $_FILES['PHOTO_PRODUCT']['tmp_name'],
            $diretorio . $nomeArquivo
        )) {
            echo "Não foi possível salvar a imagem.";
            return;
        }

        $foto = 'assets/images/products/' . $nomeArquivo;
    }

    // Atualiza o produto na Model
    $sucesso = $this->model->alter(
        $id,
        $nome,
        $descricao,
        $preco,
        $foto,
        $estoque,
        $categoria
    );

    if ($sucesso) {
        header('Location: ' . BASE_URL . 'product/list');
        exit;
    } else {
        echo "Não foi possível atualizar o produto.";
    }


}




public function createForm()
{
     $categoryModel = new CategoryModel($this->db);
    $categorias = $categoryModel->listAll();
    require_once __DIR__ . '/../Views/Dashboard/criarProduto.php';
}

public function createFormSubmit()
{
   
    $name = trim($_POST['NAME_PRODUCT'] ?? '');
    $descricao = trim($_POST['DESCRIPTION_PRODUCT'] ?? '');
    $price = trim($_POST['PRICE_PRODUCT'] ?? '');
    $stock = trim($_POST['STOCK_PRODUCT'] ?? '');
    $categoria = trim($_POST['ID_CATEGORY_FK'] ?? '');

    // A foto será recebida por $_FILES, não por $_POST.

    $photo = null;

if (isset($_FILES['PHOTO_PRODUCT']) &&
    $_FILES['PHOTO_PRODUCT']['error'] === UPLOAD_ERR_OK) {

    $nomeArquivo = uniqid() . '_' . basename($_FILES['PHOTO_PRODUCT']['name']);

    $diretorio = __DIR__ . '/../assets/images/products/';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    if (move_uploaded_file(
        $_FILES['PHOTO_PRODUCT']['tmp_name'],
        $diretorio . $nomeArquivo
    )) {
        $photo = 'assets/images/products/' . $nomeArquivo;
    }
}

     


    $this->db->begin_transaction();

    $sucesso = $this->model->create(
        $name,
        $descricao,
        $price,
        $photo,
        $stock,
        $categoria
    );

    if ($sucesso) {

     $_SESSION['mensagem'] = 'Produto criado com sucesso!';

        $this->db->commit();

        header('Location: ' . BASE_URL . 'product/list');
        exit;
    }

    $this->db->rollback();

    echo "Erro ao cadastrar produto.";
}




    // Helper para padronizar as respostas em JSON com o HTTP Status
    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

}
