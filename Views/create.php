<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
</head>

<body>
    <div class="card">
        <h2>Criar Nova Conta</h2>

        <!-- mensagem de erro caso o cadastro falhe -->
        <?php if (isset($_GET['erro'])): ?>
            <div class="msg error">Erro ao criar conta. Tente outro e-mail.</div>
        <?php endif; ?>

        <!-- o formulário envia os dados via POST para o controller na ação de create -->
        <form action="../Controllers/accountController.php?action=create" method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="admin_code">Código/Senha Universal (Apenas para Funcionários):</label>
                <input type="password" id="admin_code" name="admin_code" placeholder="Deixe em branco se for cliente">
            </div>

            <button type="submit" class="btn-submit">Criar minha conta</button>
        </form>

        <div class="login-link">
            Já tem uma conta? <a href="login.php">Faça login</a>
        </div>
    </div>
</body>

</html>