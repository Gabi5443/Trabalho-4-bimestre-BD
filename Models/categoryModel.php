<?php

class categoryModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function create($NAME_CATEGORY) {
    
        $sql = "INSERT INTO CATEGORY (NAME_CATEGORY) 
                VALUES (?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("s", $NAME_CATEGORY);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; 
    }

    public function listAll() {
        $sql = "SELECT * FROM CATEGORY";
        
        $resultado = $this->conexao->query($sql);
        
        if ($resultado) {
            // Transforma todos os resultados em um array associativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Retorna um array vazio caso dê erro
    }

    public function listById($ID_CATEGORY ) {
        $sql = "SELECT * FROM CATEGORY WHERE ID_CATEGORY  = ?";
        
        $stmt = $this->conexao->prepare($sql);
        
        if (!$stmt) {
            return null; // Retorna nulo se houver erro na query
        }

        $stmt->bind_param("i", $ID_CATEGORY);
        
        $stmt->execute();
        
        // Pega o resultado da consulta
        $resultado = $stmt->get_result();
        
        // fetch_assoc() traz apenas uma linha em formato de array associativo
        $category = $resultado->fetch_assoc();
        
        $stmt->close();
        
        // Retorna o array do produto (ou null se não encontrar nenhum com esse ID)
        return $category;
    }

    public function alter($ID_CATEGORY, $NAME_CATEGORY) {
        
        $sql = "UPDATE CATEGORY SET 
                    NAME_CATEGORY = ?
                WHERE ID_CATEGORY = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("si", $NAME_CATEGORY, $ID_CATEGORY);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }

    public function delete($ID_CATEGORY) {
        $sql = "DELETE FROM CATEGORY WHERE ID_CATEGORY = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ID_CATEGORY);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }
    
}
?>
 
