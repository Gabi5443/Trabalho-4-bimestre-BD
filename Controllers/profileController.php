
<?php

require_once __DIR__ . '/../models/WorkerModel.php';
require_once __DIR__ . '/../models/ClientModel.php';

class ProfileController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Recebe o método HTTP e decide a operação
    public function handleRequest($method, $id = null) {
        switch (strtoupper($method)) {
            case 'GET':
                $this->edit();
                break;

            case 'POST':
                $this->update();
                break;

            case 'PUT':
                $this->response([
                    'message' => 'Use POST para atualizar o perfil com upload de foto.'
                ], 405);
                break;

            case 'DELETE':
                $this->response([
                    'message' => 'Exclusão de perfil não implementada.'
                ], 405);
                break;

            default:
                $this->response([
                    'message' => 'Método HTTP não permitido.'
                ], 405);
                break;
        }
    }

    // Exibe o formulário do perfil
    private function edit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Compatível com os nomes usados pela AccountController anterior
        $userId = $_SESSION['id_account'] ?? null;
        $userType = $_SESSION['type_account'] ?? 'CLIENT';

        if (!$userId) {
            header('Location: index.php?url=account/login');
            exit();
        }

        $model = ($userType === 'WORKER')
            ? new WorkerModel($this->db)
            : new ClientModel($this->db);

        $usuario = $model->getProfileData($userId);

        if (!$usuario) {
            http_response_code(404);
            echo 'Perfil não encontrado.';
            exit();
        }

        require __DIR__ . '/../views/profile/index.php';
    }

    // Atualiza o perfil
    private function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['id_account'] ?? null;
        $userType = $_SESSION['type_account'] ?? 'CLIENT';

        if (!$userId) {
            header('Location: index.php?url=account/login');
            exit();
        }

        $nome = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($nome === '' || $email === '') {
            header('Location: index.php?url=profile&error=1');
            exit();
        }

        $nomeFoto = null;

        // Processa o upload da foto, se uma nova foi enviada
        if (isset($_FILES['photo']) &&
            $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {

            if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                header('Location: index.php?url=profile&error=upload');
                exit();
            }

            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];
            $extensao = strtolower(
                pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION)
            );

            // Verificação básica do tipo e tamanho do arquivo
            $tipoMime = (new finfo(FILEINFO_MIME_TYPE))
                ->file($_FILES['photo']['tmp_name']);

            $mimesPermitidos = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'webp' => 'image/webp'
            ];

            if (
                !isset($mimesPermitidos[$extensao]) ||
                $tipoMime !== $mimesPermitidos[$extensao]
            ) {
                header('Location: index.php?url=profile&error=photo');
                exit();
            }

            $prefixo = strtolower($userType);
            $nomeFoto = $prefixo . '_' . $userId . '_' .
                bin2hex(random_bytes(8)) . '.' . $extensao;

            $pastaDestino = __DIR__ . '/../uploads/';

            if (!is_dir($pastaDestino)) {
                mkdir($pastaDestino, 0755, true);
            }

            if (!move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $pastaDestino . $nomeFoto
            )) {
                header('Location: index.php?url=profile&error=upload');
                exit();
            }
        }

        // A atualização depende dos métodos existentes nas Models.
        // Confirme a assinatura de updateProfile() antes de utilizar.
        if ($userType === 'WORKER') {
            $model = new WorkerModel($this->db);
        } else {
            $model = new ClientModel($this->db);
        }

        if (!method_exists($model, 'updateProfile')) {
            http_response_code(501);
            echo 'Implemente updateProfile() na Model correspondente.';
            exit();
        }

        $sucesso = $model->updateProfile(
            $userId,
            $nome,
            $email,
            $nomeFoto
        );

        if ($sucesso) {
            header('Location: index.php?url=profile&success=1');
        } else {
            header('Location: index.php?url=profile&error=1');
        }

        exit();
    }

    // Respostas JSON para erros da API
    private function response($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
