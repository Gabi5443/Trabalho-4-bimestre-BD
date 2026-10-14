<?php

class workerModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function create($NAME_WORKER, $REGISTRATION_WORKER, $ROLE_WORKER, $PHOTO_WORKER, $ID_ACCOUNT_FK) {
    
        $sql = "INSERT INTO WORKER (NAME_WORKER, REGISTRATION_WORKER, ROLE_WORKER, PHOTO_WORKER, ID_ACCOUNT_FK) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssi", $NAME_WORKER, $REGISTRATION_WORKER, $ROLE_WORKER, $PHOTO_WORKER, $ID_ACCOUNT_FK);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; 
    }

    public function listAll() {
        $sql = "SELECT * FROM WORKER";
        
        $resultado = $this->conexao->query($sql);
        
        if ($resultado) {
            // Transforma todos os resultados em um array associativo
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        
        return []; // Retorna um array vazio caso dê erro
    }

    public function listById($ID_WORKER) {
        $sql = "SELECT * FROM WORKER WHERE ID_WORKER = ?";
        
        $stmt = $this->conexao->prepare($sql);
        
        if (!$stmt) {
            return null; // Retorna nulo se houver erro na query
        }

        $stmt->bind_param("i", $ID_WORKER);
        
        $stmt->execute();
        
        // Pega o resultado da consulta
        $resultado = $stmt->get_result();
        
        // fetch_assoc() traz apenas uma linha em formato de array associativo
        $worker = $resultado->fetch_assoc();
        
        $stmt->close();
        
        // Retorna o array do produto (ou null se não encontrar nenhum com esse ID)
        return $worker;
    }

    public function alter($ID_WORKER, $NAME_WORKER, $REGISTRATION_WORKER, $ROLE_WORKER, $PHOTO_WORKER, $ID_ACCOUNT_FK) {
        
        $sql = "UPDATE WORKER SET 
                    NAME_WORKER = ?, 
                    REGISTRATION_WORKER = ?, 
                    ROLE_WORKER = ?, 
                    PHOTO_WORKER = ?, 
                    ID_ACCOUNT_FK = ? 
                WHERE ID_WORKER = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssi", $NAME_WORKER, $REGISTRATION_WORKER, $ROLE_WORKER, $PHOTO_WORKER, $ID_ACCOUNT_FK, $ID_WORKER);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }

    public function delete($ID_WORKER) {
        $sql = "DELETE FROM WORKER WHERE ID_WORKER = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ID_WORKER);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado; // Retorna true se deu certo ou false se deu erro
    }


    // Busca Nome, E-mail e Foto do Funcionário
public function getProfileData($idAccount) {
    $sql = "SELECT A.NAME_ACCOUNT, A.EMAIL_ACCOUNT, W.PHOTO_WORKER, W.ROLE_WORKER 
            FROM ACCOUNT A 
            INNER JOIN WORKER W ON A.ID_ACCOUNT = W.ID_ACCOUNT_FK 
            WHERE A.ID_ACCOUNT = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $idAccount);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Atualiza Nome/E-mail na ACCOUNT e insere/atualiza o nome da Foto na WORKER
public function updateProfileData($idAccount, $nome, $email, $nomeFoto = null) {
    // 1. Atualiza ACCOUNT
    $sqlA = "UPDATE ACCOUNT SET NAME_ACCOUNT = ?, EMAIL_ACCOUNT = ? WHERE ID_ACCOUNT = ?";
    $stmtA = $this->db->prepare($sqlA);
    $stmtA->bind_param("ssi", $nome, $email, $idAccount);
    $stmtA->execute();

    // 2. Insere/atualiza o caminho da foto na WORKER se enviado
    if (!empty($nomeFoto)) {
        $sqlW = "UPDATE WORKER SET PHOTO_WORKER = ? WHERE ID_ACCOUNT_FK = ?";
        $stmtW = $this->db->prepare($sqlW);
        $stmtW->bind_param("si", $nomeFoto, $idAccount);
        $stmtW->execute();
    }
}
    
}
?>
 
