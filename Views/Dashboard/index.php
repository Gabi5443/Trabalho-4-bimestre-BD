<?php
/** @var int $qntProdutos */
/** @var int $qntClientes */
/** @var int $qntFuncionarios */
/** @var int|float $precoMedio */

// Define a foto padrão caso o utilizador não tenha escolhido nenhuma
$fotoPerfil = !empty($_SESSION['photo'])
    ? '/Trabalho-4-bimestre-BD/uploads/' . htmlspecialchars($_SESSION['photo'])
    : '/Trabalho-4-bimestre-BD/uploads/photoDefault.jpg';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
            background-color: #ffefe5;
            font-family: "Manrope", sans-serif;
        }


        body {
            display: flex;
            align-items: stretch;
        }

        .sidebar {
            background-color: #fff;
            overflow: hidden;
            z-index: 1;

            flex: 0 0 clamp(12rem, 18vw, 16rem);
            min-height: 100vh;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: clamp(1rem, 3vw, 2.5rem);
        }


        .logo-marca {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding-right: 25px;
            pointer-events: none;
            margin: 10%;
        }

        .logo-marca h1 {
            font-family: "Fascinate Inline", system-ui;
            font-size: clamp(2rem, 5vw, 3rem);
            color: #526832;
            text-align: center;
            line-height: 1.1;
        }

        .pimentinha {
            position: absolute;
            width: 20%;
            height: auto;
            right: 0;
            bottom: -10px;
            transform: rotate(10deg);
        }


        .list {
            display: flex;
            flex-direction: column;
            margin-top: 2%;
        }

        .middle {
            height: 85vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .produtos,
        .clientes,
        .funcionarios {
            
            margin-bottom: 7%;
            padding: 2%;

            display: flex;
            align-items: center;
            gap: 4%;

            text-decoration: none;
            color: #b3b3b3;
            
            transition: background 0.3s, color 0.3s;
        }

        .produtos:hover,
        .clientes:hover,
        .funcionarios:hover {
            color: #ff7f2a;
            background-color: #ffefe5;
        }

        .produtoimg,
        .clienteimg,
        .funcionarioimg {
            width: 16%;
        }


        .perfil {
            display: flex;
            align-items: center;
            text-decoration: none;
            
            padding: 1%;
            
            color: #b3b3b3;
            transition: background 0.3s;
            margin-bottom: 2rem;
        }

        .perfil:hover {
            background-color: #b3b3b34b;
        }

        .perfil img {
            width: 3rem;
            margin-inline: 5%;
            border-radius: 50%;
            object-fit: cover;

            transition: transform 0.2s;
        }

        .perfil img:hover {
            transform: scale(1.05);
        }



        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: clamp(1rem, 2vw, 2rem);
            margin-top: 3rem;
        }

        .eachCard {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.7rem;
            min-width: 0;
        }

        .pratosCadastrados,
        .clientesCadastrados,
        .funcionariosCadastrados,
        .precoMedio {
            width: 100%;
            min-height: 7rem;
            padding: 1.5rem;
            color: #526832;
            background-color: #fff;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            font-size: clamp(1rem, 1.5vw, 1.4rem);
            font-weight: 600;
        }

        .eachCard p {
            color: #78675c;
            font-size: 0.9rem;
            text-align: center;
            font-weight: 700;
        }

        /* ACESSO RÁPIDO */

        .acoesDashboard {
            margin-top: 1rem;
        }

        .acoesDashboard h2 {
            color: #526832;
            font-size: clamp(1.2rem, 2vw, 1.6rem);
            margin-bottom: 0.4rem;
        }

        .acoesDashboard>p {
            color: #a3978e;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .containerAcoes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.2rem;
        }

        .cardAcao {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.3rem;

            background-color: #fff;
            border: 1px solid #eee2d9;
            border-radius: 12px;

            text-decoration: none;
            color: #526832;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, border-color 0.2s;
        }

        .cardAcao:hover {
            transform: translateY(-3px);
            border-color: #ffbe33;
        }

        .cardAcao img {
            width: 2rem;
            flex-shrink: 0;
        }

        .cardAcao h3 {
            font-size: 0.95rem;
        }

        .cardAcao p {
            color: #a3978e;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        /* RESPONSIVIDADE */

        @media (max-width: 900px) {

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .containerAcoes {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            body {
                flex-direction: column;
            }

            .sidebar {
                flex: none;
                width: 100%;
                min-height: auto;
            }

            .logo-marca {
                margin: 1rem;
            }

            .middle {
                height: auto;
            }

            .list {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.3rem;
                margin: 0.5rem;
            }

            .produtos,
            .clientes,
            .funcionarios {
                flex-direction: column;
                text-align: center;
                font-size: 0.75rem;
                gap: 0.4rem;
                margin: 0;
                padding: 0.5rem;
            }

            .produtoimg,
            .clienteimg,
            .funcionarioimg {
                width: 2rem;
            }

            .perfil {
                margin: 0.5rem;
            }

            .perfil img {
                width: 2.5rem;
            }

            .main {
                padding: 1.2rem;
            }

            .cards {
                gap: 1rem;
            }

            .pratosCadastrados,
            .clientesCadastrados,
            .funcionariosCadastrados,
            .precoMedio {
                min-height: 5rem;
                padding: 1rem;
            }

            .acoesDashboard {
                margin-top: 2rem;
            }
        }

        @media (max-width: 350px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }

        .info {
            color: #526832;
            font-size: clamp(1.2rem, 2vw, 1.6rem);
            margin-bottom: 0.4rem;
            margin-top: 2rem;
        }

        .infoP {
            color: #a3978e;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;

        }

        .brand {
            font-size: clamp(1.2rem, 2vw, 1.6rem);
            font-family: "Fascinate Inline", system-ui;

        }
    </style>
</head>

<body>



    <header class="sidebar">

        <div class="logo-marca">
            <h1>Defufu</h1>
            <img src="<?= BASE_URL ?>assets/images/pimentinha.svg" alt="" class="pimentinha">
        </div>

        <div class="middle">

            <nav class="list">

                <a class="produtos" href="<?= BASE_URL ?>product/list">
                    <img src="<?= BASE_URL ?>assets/images/produtos.svg" class="produtoimg" alt="">
                    Listar produtos
                </a>

                <a class="clientes" href="<?= BASE_URL ?>client/list">
                    <img src="<?= BASE_URL ?>assets/images/cliente.svg" class="clienteimg" alt="">
                    Listar clientes
                </a>

                <a class="funcionarios" href="<?= BASE_URL ?>worker/list">
                    <img src="<?= BASE_URL ?>assets/images/funcionario.svg" class="funcionarioimg" alt="">
                    Listar funcionários
                </a>

            </nav>

            <a class="perfil" href="<?= BASE_URL ?>index.php?url=profile">
                <img src="<?= $fotoPerfil ?>" alt="Meu Perfil">
                <p>Meu Perfil</p>
            </a>

        </div>

    </header>


    <main class="main">







        <section class="acoesDashboard">

            <h2>Acesso rápido</h2>
            <p>O que deseja cadastrar hoje?</p>

            <div class="containerAcoes">

                <a href="<?= BASE_URL ?>worker/create" class="cardAcao">
                    <img src="<?= BASE_URL ?>assets/images/funcionario.svg" alt="">
                    <div>
                        <h3>Novo funcionário</h3>
                        <p>Adicionar alguém à equipe</p>
                    </div>
                </a>

                <a href="<?= BASE_URL ?>client/create" class="cardAcao">
                    <img src="<?= BASE_URL ?>assets/images/cliente.svg" alt="">
                    <div>
                        <h3>Novo cliente</h3>
                        <p>Cadastrar um novo cliente</p>
                    </div>
                </a>

                <a href="<?= BASE_URL ?>product/create" class="cardAcao">
                    <img src="<?= BASE_URL ?>assets/images/produtos.svg" alt="">
                    <div>
                        <h3>Novo produto</h3>
                        <p>Adicionar ao cardápio</p>
                    </div>
                </a>

            </div>

        </section>

        <h2 class="info">Dados <span class='brand'>Defufu</span></h2>
        <p class="infoP">Informações importantes no sistema</p>



        <section class="cards">



            <div class="eachCard">
                <div class="pratosCadastrados">
                    <?= $qntProdutos ?>
                </div>
                <p>Produtos</p>
            </div>

            <div class="eachCard">
                <div class="clientesCadastrados">
                    <?= $qntClientes ?>
                </div>
                <p>Clientes</p>
            </div>

            <div class="eachCard">
                <div class="funcionariosCadastrados">
                    <?= $qntFuncionarios ?>
                </div>
                <p>Funcionários</p>
            </div>

            <div class="eachCard">
                <div class="precoMedio">
                    <?= 'R$ ' . number_format((float) $precoMedio, 2, ',', '.') ?>
                </div>
                <p>Preço médio</p>
            </div>

        </section>

    </main>

</body>

</html>