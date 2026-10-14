<?php
require_once 'models/WorkerModel.php';
require_once 'models/ClientModel.php';

class ProfileController {
    private $db;

    public function __construct($db) {
        $this->db =$db;
    }

    public function handleRequest($action) {
        switch ($action) {
            case 'edit':
            case 'index':
                $this->edit();
                break;

            case 'update':
                $this->update();
                break;

            default:
                $this->edit();
                break;
        }
    }

    private function edit() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $userId   =$_SESSION['user_id'] ?? null;
        $userType =$_SESSION['user_type'] ?? 'CLIENT';

        if (!$userId) {
            header("Location: index.php?url=login");
            exit();
        }

        if ($userType === 'WORKER') {
            $model = new WorkerModel($this->db);
        } else {
            $model = new ClientModel($this->db);
        }

        $usuario = $model->getProfileData($userId);
        require_once 'views/profile/index.php';
    }

    private function update() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $userId   =$_SESSION['user_id'] ?? null;
        $userType =$_SESSION['user_type'] ?? 'CLIENT';

        if (!$userId \vert{}\vert{}$_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?url=login");
            exit();
        }

        $nome  = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($nome) \vert{}\vert{} empty($email)) {
            header("Location: index.php?url=profile/edit&error=1");
            exit();
        }

        $nomeFoto = null;

        // Processa o upload da nova foto
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {$extensao = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($extensao,$extensoesPermitidas)) {
                $prefixo = strtolower($userType);
                $nomeFoto =$prefixo . '_' . $userId . '_' . time() . '.' . $extensao;
                $pastaDestino = 'uploads/';

                if (!is_dir($pastaDestino)) {
                    mkdir($pastaDestino, 0777, true);
                }

                move_uploaded_file($_FILES['photo']['tmp_name'], $pastaDestino .$nomeFoto);
            }
        }

        // Atualiza no BD conforme o tipo de usuário
        if ($userType === 'WORKER') {
