<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="login-card">
        <!-- menssagem de feedback da controller -->
        <?php if (isset($_GET['erro'])): ?>
            <div class="msg error-msg">E-mail ou senha inválidos!</div>
        <?php elseif (isset($_GET['sucesso'])): ?>
            <div class="msg success-msg">Conta criada com sucesso! Faça login.</div>
        <?php endif; ?>

        <form action="../controllers/accountController.php?action=login" method="POST">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn-submit">Entrar</button>
        </form>

        <div class="create-link">
            Ainda não tem uma conta? <a href="create.php">Criar conta</a>
        </div>
    </div>
</body>

</html>