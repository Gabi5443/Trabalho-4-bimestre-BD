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
    <style>
        * {
            margin: 0;
            border: 0;
            padding: 0;

        }

        .title {
            color: brown;
        }

        .form {
            width: 50%;
            height: 70%;
            background-color: blue;
            display: flex;
            justify-content: center;
            justify-items: center;
            flex-direction: column;
            gap: 2rem;

        }

        .formGroup {
            align-items: center;
            justify-content: center;
            display: flex;

        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>

</head>

<body>



    <?php if (isset($_GET['success'])): ?>
        <p>Perfil atualizado com sucesso!</p>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <p>Não foi possível atualizar o perfil. Verifique os dados e tente novamente.</p>
    <?php endif; ?>


    <div class="form">

        <div class="formGroup">

            <h1 class="title">Meu perfil</h1>
        </div>

        <form action="index.php?url=profile" method="POST"
            enctype="multipart/form-data">
            <div class="formGroup">
                <label for="name">Nome:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= htmlspecialchars($usuario['NAME_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required>
            </div>


            <div class="formGroup">
                <label for="email">E-mail:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($usuario['EMAIL_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required>

            </div>

            <div class="formGroup">


                <?php if ($caminhoFoto): ?>
                    <div class="fotoProfile">
                        <p>Foto atual:</p>
                        <img
                            src="<?= htmlspecialchars($caminhoFoto, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Foto de perfil"
                            width="150"
                            height="150"
                            style="object-fit: cover;">
                    </div>
                <?php endif; ?>

            </div>

            <div class="formGroup">
                <p>Selecione uma nova foto somente se quiser alterar a atual.</p>
            </div>

            <div class="formGroup">

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept=".jpg,.jpeg,.png,.webp">

            </div>



            <div class="formGroup">
                <button type="submit" class="BotaoSubmit">Salvar alterações</button>
            </div>
        </form>
    </div>
</body>

</html>