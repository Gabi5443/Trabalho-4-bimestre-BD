
<?php

class AccountModel
{
    private $conexao;

    public function __construct($db)
    {
        $this->conexao = $db;
    }
public function create($NAME_ACCOUNT, $EMAIL_ACCOUNT, $PASSWORD_ACCOUNT, $TYPE_ACCOUNT)
{
    $sql = "INSERT INTO ACCOUNT (NAME_ACCOUNT, EMAIL_ACCOUNT, PASSWORD_ACCOUNT, TYPE_ACCOUNT) VALUES (?, ?, ?, ?)";

    $stmt = $this->conexao->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssss",
        $NAME_ACCOUNT,
        $EMAIL_ACCOUNT,
        $PASSWORD_ACCOUNT,
        $TYPE_ACCOUNT
    );

    try {
        $resultado = $stmt->execute();
        $stmt->close();
        return true;
    } catch (mysqli_sql_exception $e) {
     
        if ($e->getCode() == 1062) {
            throw new Exception("Este e-mail já está registado. Por favor, utilize outro.");
        }
        throw $e;
    }
}

    public function listAll()
    {
        $sql = "SELECT * FROM ACCOUNT";
        $resultado = $this->conexao->query($sql);

        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function listById($ID_ACCOUNT)
    {
        $sql = "SELECT * FROM ACCOUNT WHERE ID_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $ID_ACCOUNT);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $account = $resultado->fetch_assoc();

        $stmt->close();

        return $account;
    }

    public function findByEmail($EMAIL_ACCOUNT)
    {
        $sql = "SELECT * FROM ACCOUNT WHERE EMAIL_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $EMAIL_ACCOUNT);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $account = $resultado->fetch_assoc();

        $stmt->close();

        return $account;
    }

    public function alter(
        $ID_ACCOUNT,
        $NAME_ACCOUNT,
        $EMAIL_ACCOUNT,
        $PASSWORD_ACCOUNT,
        $TYPE_ACCOUNT
    ) {
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

        $stmt->bind_param(
            "ssssi",
            $NAME_ACCOUNT,
            $EMAIL_ACCOUNT,
            $PASSWORD_ACCOUNT,
            $TYPE_ACCOUNT,
            $ID_ACCOUNT
        );

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    public function delete($ID_ACCOUNT)
    {
        $sql = "DELETE FROM ACCOUNT WHERE ID_ACCOUNT = ?";

        $stmt = $this->conexao->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $ID_ACCOUNT);

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }

    // Atualiza as informações do perfil
    public function updateProfile($id, $nome, $email, $foto)
    {
        if ($foto !== null) {
            $sql = "UPDATE ACCOUNT SET
                        NAME_ACCOUNT = ?,
                        EMAIL_ACCOUNT = ?,
                        PHOTO_ACCOUNT = ?
                    WHERE ID_ACCOUNT = ?";

            $stmt = $this->conexao->prepare($sql);

            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("sssi", $nome, $email, $foto, $id);
        } else {
            $sql = "UPDATE ACCOUNT SET
                        NAME_ACCOUNT = ?,
                        EMAIL_ACCOUNT = ?
                    WHERE ID_ACCOUNT = ?";

            $stmt = $this->conexao->prepare($sql);

            if (!$stmt) {
                return false;
            }

            $stmt->bind_param("ssi", $nome, $email, $id);
        }

        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }
}
?>
