<?php
$tipoUsuario = $_SESSION['type_account'] ?? 'CLIENT';

if ($tipoUsuario === 'WORKER') {
    $foto = $usuario['PHOTO_WORKER'] ?? null;
} else {
    $foto = $usuario['PHOTO_CLIENT'] ?? null;
}

$caminhoFoto = $foto
    ? '/Trabalho-4-bimestre-BD/uploads/' . rawurlencode(basename($foto))
    : '/Trabalho-4-bimestre-BD/uploads/photoDefault.jpg';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu perfil</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image:
                url(' /Trabalho-4-bimestre-BD/assets/images/folhacima.png'),
                url('/Trabalho-4-bimestre-BD/assets/images/folhabaixo.png');

            background-position:
                top right,
                bottom left;
            background-repeat: no-repeat;
            background-size: 20% auto, 20% auto;
            padding: 1rem;
            font-family: "Sniglet", system-ui;
            background-color: #e7e7e7;
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            max-width: 28rem;
            padding: 2rem 2rem;
            border-radius: 2rem;
            background-color: #fff;
            border: 0.7rem solid #A0522D;
            outline: 0.2rem solid #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h1 {

            color: #556B2F;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 1.2rem;
        }

        .inside {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
        }

        .form-group label, h3 {
            color: #556B2F;
            font-size: 0.95rem;
            margin-bottom: 0.4rem;
            font-weight: 600;
            align-items: flex-start;
        }

        .form-group input {
            width: 100%;
        }


        .box-photo {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 3rem;
            color: #556B2F;
            font-size: 2rem;
            margin-bottom: 0.10rem;
            font-weight: 600;
        }

        [name="name"],
        [name="email"],
        [name="photo"] {
            border-radius: 20px;
            border: 1.5px solid #556B2F;
            width: 85%;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            color: #333333;
            background-color: #FAFAFA;
            box-shadow: 0 0 8px rgba(226, 114, 91, 0.15);
            transition: border 0.2s ease;
        }

        [name="name"]:focus,
        [name="email"]:focus,
        [name="photo"]:focus {
            border: 2px solid #556B2F;
            outline: none;
        }

        .btn-submit {
            width: 85%;
            padding: 0.8rem;
            font-family: "Sniglet", system-ui;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
            background-color: #556B2F;
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover {
            background-color: #A0522D;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .box-photo {
                gap: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="box">

        <h1>Meu perfil</h1>
        <div class="inside">
            <form action="index.php?url=profile" method="POST" enctype="multipart/form-data">
                <?php if (isset($_GET['success'])): ?>
                    <p>Perfil atualizado com sucesso!</p>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <p>Não foi possível atualizar o perfil. Verifique os dados e tente novamente.</p>
                <?php endif; ?>

                <?php if ($caminhoFoto): ?>
                    <div class="box-photo">
                        <p>Foto atual:</p>
                        <img src="<?= htmlspecialchars($caminhoFoto, ENT_QUOTES, 'UTF-8') ?>" alt="Foto de perfil" width="150" height="150" style="object-fit: cover;">
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name"
                        value="<?= htmlspecialchars($usuario['NAME_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>


                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($usuario['EMAIL_ACCOUNT'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>


                <div class="form-group">
                    <label for="photo">Foto de perfil:</label>
                    <input type="file" id="photo" name="photo" accept=".jpg,.jpeg,.png,.webp">
                </div>
                <h3>Selecione uma nova foto somente se quiser alterar a atual.</h3>

                <button type="submit" class="btn-submit">Salvar alterações</button>
            </form>
        </div>
    </div>

</body>

</html>