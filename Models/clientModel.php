<?php

class clientModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function create($NAME_CLIENT, $CPF_CLIENT, $NUMBER_CLIENT, $PHOTO_CLIENT, $ID_ACCOUNT_FK) {
    
        $sql = "INSERT INTO CLIENT (NAME_CLIENT, CPF_CLIENT, NUMBER_CLIENT, PHOTO_CLIENT, ID_ACCOUNT_FK) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssi", $NAME_CLIENT, $CPF_CLIENT, $NUMBER_CLIENT, $PHOTO_CLIENT, $ID_ACCOUNT_FK);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; 
    }

    public function listAll() {
        $sql = "SELECT * FROM CLIENT";
        
        $resultado = $this->conexao->query($sql);
        
        if ($resultado) {
            // Transforma todos os resultados em um array associativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Retorna um array vazio caso dê erro
    }

    public function listById($ID_CLIENT) {
        $sql = "SELECT * FROM CLIENT WHERE ID_CLIENT = ?";
        
        $stmt = $this->conexao->prepare($sql);
        
        if (!$stmt) {
            return null; // Retorna nulo se houver erro na query
        }

        $stmt->bind_param("i", $ID_CLIENT);
        
        $stmt->execute();
        
        // Pega o resultado da consulta
        $resultado = $stmt->get_result();
        
        // fetch_assoc() traz apenas uma linha em formato de array associativo
        $client = $resultado->fetch_assoc();
        
        $stmt->close();
        
        // Retorna o array do produto (ou null se não encontrar nenhum com esse ID)
        return $client;
    }

    public function alter($ID_CLIENT, $NAME_CLIENT, $CPF_CLIENT, $NUMBER_CLIENT, $PHOTO_CLIENT, $ID_ACCOUNT_FK) {
        
        $sql = "UPDATE CLIENT SET 
                    NAME_CLIENT = ?, 
                    CPF_CLIENT = ?, 
                    NUMBER_CLIENT = ?, 
                    PHOTO_CLIENT = ?, 
                    ID_ACCOUNT_FK = ? 
                WHERE ID_CLIENT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssii", $NAME_CLIENT, $CPF_CLIENT, $NUMBER_CLIENT, $PHOTO_CLIENT, $ID_ACCOUNT_FK, $ID_CLIENT);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }

    public function delete($ID_CLIENT) {
        $sql = "DELETE FROM CLIENT WHERE ID_CLIENT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ID_CLIENT);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }
    
}
?>
 
