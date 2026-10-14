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

    // Busca Nome, E-mail e Foto do Cliente
public function getProfileData($idAccount) {
    $sql = "SELECT A.NAME_ACCOUNT, A.EMAIL_ACCOUNT, C.PHOTO_CLIENT 
            FROM ACCOUNT A 
            INNER JOIN CLIENT C ON A.ID_ACCOUNT = C.ID_ACCOUNT_FK 
            WHERE A.ID_ACCOUNT = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $idAccount);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Atualiza ACCOUNT e insere/atualiza a Foto na CLIENT
public function updateProfileData($idAccount, $nome, $email, $nomeFoto = null) {
    $sqlA = "UPDATE ACCOUNT SET NAME_ACCOUNT = ?, EMAIL_ACCOUNT = ? WHERE ID_ACCOUNT = ?";
    $stmtA = $this->db->prepare($sqlA);
    $stmtA->bind_param("ssi", $nome, $email, $idAccount);
    $stmtA->execute();

    if (!empty($nomeFoto)) {
        $sqlC = "UPDATE CLIENT SET PHOTO_CLIENT = ? WHERE ID_ACCOUNT_FK = ?";
        $stmtC = $this->db->prepare($sqlC);
        $stmtC->bind_param("si", $nomeFoto, $idAccount);
        $stmtC->execute();
    }
}
    
}
?>
 
