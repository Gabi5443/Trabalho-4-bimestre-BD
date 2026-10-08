<?php

class productModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    // Método Create
    public function create($NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK) {
    
        $sql = "INSERT INTO PRODUCT (NAME_PRODUCT, DESCRIPTION_PRODUCT, PRICE_PRODUCT, PHOTO_PRODUCT, STOCK_PRODUCT, ID_CATEGORY_FK) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssdsii", $NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; 
    }

    public function listAll() {
        $sql = "SELECT * FROM PRODUCT";
        
        $resultado = $this->conexao->query($sql);
        
        if ($resultado) {
            // Transforma todos os resultados em um array associativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Retorna um array vazio caso dê erro
    }

    public function listById($id) {
        $sql = "SELECT * FROM PRODUCT WHERE ID_PRODUCT = ?";
        
        $stmt = $this->conexao->prepare($sql);
        
        if (!$stmt) {
            return null; // Retorna nulo se houver erro na query
        }

        // "i" significa que o parâmetro $id é um número inteiro (integer)
        $stmt->bind_param("i", $id);
        
        $stmt->execute();
        
        // Pega o resultado da consulta
        $resultado = $stmt->get_result();
        
        // fetch_assoc() traz apenas uma linha em formato de array associativo
        $produto = $resultado->fetch_assoc();
        
        $stmt->close();
        
        // Retorna o array do produto (ou null se não encontrar nenhum com esse ID)
        return $produto;
    }

    public function alter($id, $NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK) {
        
        $sql = "UPDATE PRODUCT SET 
                    NAME_PRODUCT = ?, 
                    DESCRIPTION_PRODUCT = ?, 
                    PRICE_PRODUCT = ?, 
                    PHOTO_PRODUCT = ?, 
                    STOCK_PRODUCT = ?, 
                    ID_CATEGORY_FK = ? 
                WHERE ID_PRODUCT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssdssii", $NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK, $id);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }

    public function delete($id) {
        $sql = "DELETE FROM PRODUCT WHERE ID_PRODUCT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }
    
}
?>
 
