

<?php
// views/profile/index.php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil</title>
</head>
<body>

    <h1>Meu perfil</h1>

    <form action="" method="POST">

        <label for="name">Nome:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($usuario['NAME_ACCOUNT'] ?? '') ?>"
            required
        >

        <br><br>

        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($usuario['EMAIL_ACCOUNT'] ?? '') ?>"
            required
        >

        <br><br>

        <button type="submit">Salvar alterações</button>

    </form>

</body>
</html>
