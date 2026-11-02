<?php
// Essa controller serve exclusivamente para atribuir o método list all da product, client e worker model à view de dashboard

class DashboardController {

    private $productModel;
    private $clientModel;
    private $workerModel;

    public function __construct($db) {
        $this->productModel = new productModel($db);
        $this->clientModel = new clientModel($db);
        $this->workerModel = new workerModel($db);
    }

    public function index() {
// O count é uma função nativa do PHP que conta quantos elementos existem em um array.
        $qntProdutos = count($this->productModel->listAll());
        $qntClientes = count($this->clientModel->listAll());
        $qntFuncionarios = count($this->workerModel->listAll());

        require_once __DIR__ . '/../Views/Dashboard/index.php';
    }
}

?>