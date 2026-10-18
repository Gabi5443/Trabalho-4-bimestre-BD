<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil</title>
</head>
<body>

    <h1>Meu perfil</h1>


<form action="index.php?url=profile" method="POST"
      enctype="multipart/form-data">

    <label for="name">Nome:</label>
    <input
        type="text"
        id="name"
        name="name"
        value="<?= htmlspecialchars($usuario['NAME_ACCOUNT'] ?? '') ?>"
        required
    >

    <label for="email">E-mail:</label>
    <input
        type="email"
        id="email"
        name="email"
        value="<?= htmlspecialchars($usuario['EMAIL_ACCOUNT'] ?? '') ?>"
        required
    >

    <label for="photo">Foto de perfil:</label>
    <input type="file" id="photo" name="photo"
           accept=".jpg,.jpeg,.png,.webp">

    <button type="submit">Salvar alterações</button>
</form>

</body>
</html>
