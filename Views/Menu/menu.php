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
            
            transition: transform 0.50s;
        }

        .Title:hover {
            transform: scale(1.05);
            -webkit-text-stroke: 0.5px #fff;
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
            transition: transform 0.50s;
        }

        .profile-button img:hover {
            transform: scale(1.05);
            outline: 0.2rem solid #556B2F;
        }

        main {
            display: flex;
            justify-content: center;
        }

        .grid {
            min-width: 90%;
            border-radius: 20px;
            display: flex;
            flex-wrap: wrap;       
            justify-content: center; 
            gap: 4rem;            
            padding: 1rem;
            
        }

        .product {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 0.2rem solid #e7e7e7;
            border-radius: 20px;
            flex: 0 1 16rem;      
            height: 20rem;      
            margin: 0;
            transition: transform 0.50s;
        }

        .product:hover {
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
                margin-top: 1rem;
            }

            .grid {
                display: flex;
                flex-direction: column;
                gap: 3rem;
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
        <!-- Agora a variável $fotoPerfil existe e está definida! -->
        <img src="<?php echo htmlspecialchars($fotoPerfil, ENT_QUOTES, 'UTF-8'); ?>" alt="Meu Perfil">
    </a>
</div>
        </div>
        <main>
            <div class="grid">
                <div class="product">pizza</div>
                <div class="product">macarrao</div>
                <div class="product">arroz</div>
                <div class="product">feijão</div>
                <div class="product">pizza</div>
                <div class="product">macarrao</div>
                <div class="product">arroz</div>
                <div class="product">feijão</div>
                <div class="product">pizza</div>
                <div class="product">macarrao</div>
                <div class="product">arroz</div>
                <div class="product">feijão</div>
            </div>
        </main>
    </div>
</body>

</html>