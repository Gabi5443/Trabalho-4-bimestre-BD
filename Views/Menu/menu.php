<?php
// Define a foto padrão caso o utilizador não tenha escolhido nenhuma
$fotoPerfil = !empty($_SESSION['photo'])
    ? '../uploads/' . htmlspecialchars($_SESSION['photo'])
    : '../uploads/photoDefault.jpg'; // Certifique-se de ter esta imagem na pasta uploads
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
                    <!-- Exibe a imagem redonda como botão redirecionando para o perfil -->
                    <img src="<?php echo $fotoPerfil; ?>" alt="Meu Perfil">
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