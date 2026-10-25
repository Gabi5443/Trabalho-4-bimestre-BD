<?php
// 1. Tenta buscar a foto diretamente da sessão
$foto = $_SESSION['photo'] ?? null;

// 2. Se a sessão não tiver, mas a variável $usuario existir, busca dela
if (!$foto && isset($usuario)) {
    $tipoUsuario = $_SESSION['type_account'] ?? 'CLIENT';
    $foto = ($tipoUsuario === 'WORKER') 
        ? ($usuario['PHOTO_WORKER'] ?? null) 
        : ($usuario['PHOTO_CLIENT'] ?? null);
}

// 3. Definimos a variável EXATAMENTE como $fotoPerfil para não dar erro
$fotoPerfil = $foto
    ? BASE_URL . 'uploads/' . rawurlencode(basename($foto))
    : BASE_URL . 'uploads/photoDefault.jpg';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Sniglet:wght@400;800&display=swap"
        rel="stylesheet">
    <title>Menu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }

        .header {
            margin: 1.5rem;
            display: flex;
            justify-content: space-between; /* Separa o título e o perfil em extremos opostos */
            align-items: center;            /* Alinha ambos verticalmente ao centro */
        }

        .Title {
            font-family: "Fascinate Inline", system-ui;
            font-size: 3rem;
        }

        .profile-button img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .profile-button img:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="config">
        <div class="header">
            <h1 class="Title">Defufu</h1>

            <div class="profile-button">
    <a href="index.php?url=profile">
        <!-- Agora a variável $fotoPerfil existe e está definida! -->
        <img src="<?php echo htmlspecialchars($fotoPerfil, ENT_QUOTES, 'UTF-8'); ?>" alt="Meu Perfil">
    </a>
</div>
        </div>
    </div>

    <main>
        <div class="scroller"></div>
        <div class="grid"></div>
    </main>

</body>

</html>