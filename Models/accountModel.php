<?php

class accountModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function create($NAME_ACCOUNT, $EMAIL_ACCOUNT, $PASSWORD_ACCOUNT, $TYPE_ACCOUNT) {
    
        $sql = "INSERT INTO ACCOUNT (NAME_ACCOUNT, EMAIL_ACCOUNT, PASSWORD_ACCOUNT, TYPE_ACCOUNT) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssss", $NAME_ACCOUNT, $EMAIL_ACCOUNT, $PASSWORD_ACCOUNT, $TYPE_ACCOUNT);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; 
    }

    public function listAll() {
        $sql = "SELECT * FROM ACCOUNT";
        
        $resultado = $this->conexao->query($sql);
        
        if ($resultado) {
            // Transforma todos os resultados em um array associativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Retorna um array vazio caso dê erro
    }

    public function listById($ID_ACCOUNT) {
        $sql = "SELECT * FROM ACCOUNT WHERE ID_ACCOUNT = ?";
        
        $stmt = $this->conexao->prepare($sql);
        
        if (!$stmt) {
            return null; // Retorna nulo se houver erro na query
        }

        $stmt->bind_param("i", $ID_ACCOUNT);
        
        $stmt->execute();
        
        // Pega o resultado da consulta
        $resultado = $stmt->get_result();
        
        // fetch_assoc() traz apenas uma linha em formato de array associativo
        $account= $resultado->fetch_assoc();
        
        $stmt->close();
        
        // Retorna o array do produto (ou null se não encontrar nenhum com esse ID)
        return $account;
    }

    public function alter($ID_ACCOUNT, $NAME_ACCOUNT, $EMAIL_ACCOUNT, $PASSWORD_ACCOUNT, $TYPE_ACCOUNT) {
        
        $sql = "UPDATE ACCOUNT SET 
                    NAME_ACCOUNT = ?, 
                    EMAIL_ACCOUNT = ?, 
                    PASSWORD_ACCOUNT = ?, 
                    TYPE_ACCOUNT = ?
                    WHERE ID_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssi", $NAME_ACCOUNT, $EMAIL_ACCOUNT, $PASSWORD_ACCOUNT, $TYPE_ACCOUNT, $ID_ACCOUNT);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }

    public function delete($ID_ACCOUNT) {
        $sql = "DELETE FROM ACCOUNT WHERE ID_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ID_ACCOUNT);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }
    
}
?>
 
