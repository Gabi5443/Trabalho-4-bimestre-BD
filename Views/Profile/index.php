<?php
$tipoUsuario = $_SESSION['type_account'] ?? 'CLIENT';

if ($tipoUsuario === 'WORKER') {
    $foto = $usuario['PHOTO_WORKER'] ?? null;
} else {
    $foto = $usuario['PHOTO_CLIENT'] ?? null;
}



$caminhoFoto = $foto
    ? '../uploads/' . rawurlencode(basename($foto))
    : null;
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

        <?php if (isset($_GET['success'])): ?>
            <p>Perfil atualizado com sucesso!</p>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <p>Não foi possível atualizar o perfil. Verifique os dados e tente novamente.</p>
        <?php endif; ?>

    <?php if ($caminhoFoto): ?>
        <div>
            <p>Foto atual:</p>
            <img
                src="<?= htmlspecialchars($caminhoFoto, ENT_QUOTES, 'UTF-8') ?>"
                alt="Foto de perfil"
                width="150"
                height="150"
                style="object-fit: cover;"
            >
        </div>
    <?php endif; ?>

    <form action="index.php?url=profile" method="POST"
          enctype="multipart/form-data">

        <label for="name">Nome:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($usuario['NAME_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($usuario['EMAIL_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <br><br>

        <label for="photo">Foto de perfil:</label>
        <input
            type="file"
            id="photo"
            name="photo"
            accept=".jpg,.jpeg,.png,.webp"
        
        >

        <p>Selecione uma nova foto somente se quiser alterar a atual.</p>

        <button type="submit">Salvar alterações</button>
    </form>

</body>

</html>