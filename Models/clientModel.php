<?php

class ClientModel {
    private $conexao;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function create($NAME_CLIENT, $CPF_CLIENT, $NUMBER_CLIENT, $PHOTO_CLIENT, $ID_ACCOUNT_FK) {

        $sql = "INSERT INTO CLIENT (
                    NAME_CLIENT,
                    CPF_CLIENT,
                    NUMBER_CLIENT,
                    PHOTO_CLIENT,
                    ID_ACCOUNT_FK
                ) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param(
            "ssssi",
            $NAME_CLIENT,
            $CPF_CLIENT,
            $NUMBER_CLIENT,
            $PHOTO_CLIENT,
            $ID_ACCOUNT_FK
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function listAll() {
        $sql = "SELECT * FROM CLIENT";

        $resultado = $this->conexao->query($sql);

        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function listById($ID_CLIENT) {
        $sql = "SELECT * FROM CLIENT WHERE ID_CLIENT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $ID_CLIENT);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $client = $resultado->fetch_assoc();

        $stmt->close();

        return $client;
    }

    public function alter(
        $ID_CLIENT,
        $NAME_CLIENT,
        $CPF_CLIENT,
        $NUMBER_CLIENT,
        $PHOTO_CLIENT,
        $ID_ACCOUNT_FK
    ) {

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

        $stmt->bind_param(
            "ssssii",
            $NAME_CLIENT,
            $CPF_CLIENT,
            $NUMBER_CLIENT,
            $PHOTO_CLIENT,
            $ID_ACCOUNT_FK,
            $ID_CLIENT
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
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

        return $resultado;
    }

    // Busca nome, e-mail e foto do cliente
    public function getProfileData($idAccount) {
        $sql = "SELECT 
                A.NAME_ACCOUNT, 
                A.EMAIL_ACCOUNT, 
                C.PHOTO_CLIENT 
            FROM ACCOUNT A
            LEFT JOIN CLIENT C 
                ON A.ID_ACCOUNT = C.ID_ACCOUNT_FK
            WHERE A.ID_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $idAccount);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $cliente = $resultado->fetch_assoc();

        $stmt->close();

        return $cliente;
    }

    // Atualiza os dados da conta e garante que a foto do cliente é salva/criada
    public function updateProfileData(
        $idAccount,
        $nome,
        $email,
        $nomeFoto = null
    ) {
        // 1. Atualiza a tabela ACCOUNT
        $sqlA = "UPDATE ACCOUNT
                 SET NAME_ACCOUNT = ?, EMAIL_ACCOUNT = ?
                 WHERE ID_ACCOUNT = ?";

        $stmtA = $this->conexao->prepare($sqlA);

        if (!$stmtA) {
            return false;
        }

        $stmtA->bind_param("ssi", $nome, $email, $idAccount);
        $resultadoA = $stmtA->execute();
        $stmtA->close();

        if (!$resultadoA) {
            return false;
        }

        // 2. Se uma nova foto foi enviada, gerimos a tabela CLIENT
        if ($nomeFoto !== null) {
            // Verifica se já existe um registo na tabela CLIENT para este ID_ACCOUNT_FK
            $sqlCheck = "SELECT ID_CLIENT FROM CLIENT WHERE ID_ACCOUNT_FK = ?";
            $stmtCheck = $this->conexao->prepare($sqlCheck);
            $stmtCheck->bind_param("i", $idAccount);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $existeClient = $resultCheck->num_rows > 0;
            $stmtCheck->close();

            if ($existeClient) {
                // Se já existe, faz UPDATE
                $sqlC = "UPDATE CLIENT SET PHOTO_CLIENT = ? WHERE ID_ACCOUNT_FK = ?";
                $stmtC = $this->conexao->prepare($sqlC);
                if (!$stmtC) return false;
                $stmtC->bind_param("si", $nomeFoto, $idAccount);
            } else {
                // Se ainda não existe, faz INSERT para não perder a foto
                $sqlC = "INSERT INTO CLIENT (PHOTO_CLIENT, ID_ACCOUNT_FK) VALUES (?, ?)";
                $stmtC = $this->conexao->prepare($sqlC);
                if (!$stmtC) return false;
                $stmtC->bind_param("si", $nomeFoto, $idAccount);
            }

            $resultadoC = $stmtC->execute();
            $stmtC->close();

            if (!$resultadoC) {
                return false;
            }
        }

        return true;
    }
}