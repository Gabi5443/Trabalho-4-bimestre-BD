<?php
    class productModel {
     <?php
    class productModel {
        public function create($NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK ) {

        $sql = "INSERT INTO PRODUCT (NAME_PRODUCT, DESCRIPTION_PRODUCT, PRICE_PRODUCT, PHOTO_PRODUCT, STOCK_PRODUCT, ID_CATEGORY_FK) VALUES (:NAME_PRODUCT, :DESCRIPTION_PRODUCT, :PRICE_PRODUCT, :PHOTO_PRODUCT, :STOCK_PRODUCT, :ID_CATEGORY_FK)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bind_param("ssdsii", $NAME_PRODUCT, $DESCRIPTION_PRODUCT, $PRICE_PRODUCT, $PHOTO_PRODUCT, $STOCK_PRODUCT, $ID_CATEGORY_FK);

            $resultado = $stmt->execute();
            $stmt->close();
            
            return $resultado;
        }
        
        return false;
    }
?>
        
    }
?>
