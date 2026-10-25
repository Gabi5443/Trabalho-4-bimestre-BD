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

        body {
            background-color: #ff7f2a;
            background-image: url('/Trabalho-4-bimestre-BD/assets/images/fundo.png');
            background-repeat: repeat;
        }

        .box {
            background-color: #fff;
            min-height: 90vh;
            margin: 8% 3% 3% 3%;
            border-radius: 20px;
            position: relative;
        }

        .Title {
            font-family: "Fascinate Inline", system-ui;
            font-size: 7rem;
            color: #556B2F;
            -webkit-text-stroke: 2px darkolivegreen;
            text-shadow: -4px -4px 0 white,
                4px -4px 0 white,
                -4px 4px 0 white,
                4px 4px 0 white;
            position: absolute;
            top: -65px;
            left: 30px;
            z-index: 20;
            line-height: 1;
            pointer-events: none;
        }

        .header {
            margin: 1.5rem;
            display: flex;
            justify-content: end;

        }

        .profile-button img {
            width: 6rem;
            height: 6rem;
            margin-top: 20%;
            margin-right: 50%;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .profile-button img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .box {
                margin-top: 12%;
            }

            .Title {
                font-size: 3.2rem;
                top: -35px;
                left: 20px;
            }

            .profile-button img {
                width: 3rem;
                height: 3rem;
            }
        }
    </style>
</head>

<body>
    <div class="box">
        <h1 class="Title">Defufu</h1>
        <div class="header">
            <div class="profile-button">
                <a href="index.php?url=profile">
                    <!-- Exibe a imagem redonda como botão redirecionando para o perfil -->
                    <img src="<?php echo $fotoPerfil; ?>" alt="Meu Perfil">
                </a>
            </div>
        </div>
        <main>
            <div class="scroller"></div>
            <div class="grid"></div>
        </main>
    </div>
</body>

</html>