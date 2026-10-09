<?php

require_once 'models/ProductModel.php';

class ProductController {
    private $model; //Chama a Model como atributo

    public function __construct($db) {
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

    // Helper para padronizar as respostas em JSON com o HTTP Status
    private function response($data, $statusCode = 200) {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
