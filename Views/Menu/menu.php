<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Sniglet:wght@400;800&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
        }

        .header {
            margin: 1.5rem;
            display: flex;
            ;
        }

        .Title {
            font-family: "Fascinate Inline", system-ui;
            font-size: 3rem;

        }
    </style>
</head>

<body>
    <div class="config">
        <div class="header">
            <h1 class="Title">Defufu</h1>

            <div class="profile-button">
                <a href="/Trabalho-4-bimestre-BD/profile">
                    <?php
                    // Define a foto padrão caso o utilizador não tenha escolhido nenhuma
                    $fotoPerfil = !empty($_SESSION['photo'])
                        ? '../../uploads/' . htmlspecialchars($_SESSION['photo'])
                        : '../../uploads/photoDefault.jpg'; // Coloque uma imagem padrão nesta pasta
                    ?>

                    <!-- Exibe a imagem redonda como botão -->
                    <img src="<?php echo $fotoPerfil; ?>" alt="Meu Perfil" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                </a>
            </div>

        </div>


    </div>

    <main>
        <div class="scroller"></div>
        <div class="grid"></div>

        <main>
            </div>

</body>

</html>