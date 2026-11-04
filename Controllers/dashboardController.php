<?php
// Essa controller serve exclusivamente para atribuir o método list all da product, client e worker model à view de dashboard

class DashboardController {

    private $productModel;
    private $clientModel;
    private $workerModel;
    private $db;

       
   
   

    public function __construct($db) {
        $this->db = $db;
        $this->productModel = new productModel($db);
        $this->clientModel = new clientModel($db);
        $this->workerModel = new workerModel($db);
    }



     public function calcularPrecoMedio() {
    $sql = "SELECT CAST(AVG(PRICE_PRODUCT) AS DECIMAL(10, 2)) AS preco_medio FROM PRODUCT";

   

    $resultado = $this->db->query($sql);

    if ($resultado) {
        $dados = $resultado->fetch_assoc();
        return $dados['preco_medio'] ?? 0;
    }
  
    return 0;


}

    public function index() {
// O count é uma função nativa do PHP que conta quantos elementos existem em um array.
        $qntProdutos = count($this->productModel->listAll());
        $qntClientes = $this->clientModel->countAll();
        $qntFuncionarios = count($this->workerModel->listAll());
        $precoMedio = $this->calcularPrecoMedio();
    

        require_once __DIR__ . '/../Views/Dashboard/index.php';
    }




   
}



?>