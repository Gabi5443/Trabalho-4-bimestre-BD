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
}
?>
 
