<?php
/** @var int $qntProdutos */
/** @var int $qntClientes */
/** @var int $qntFuncionarios */
/** @var int $precoMedio */


/*aviso pro intelephense de que essas variaveis existem */

?>

<?php
// Define a foto padrão caso o utilizador não tenha escolhido nenhuma
$fotoPerfil = !empty($_SESSION['photo'])
    ? '/Trabalho-4-bimestre-BD/uploads/' . htmlspecialchars($_SESSION['photo'])
    : '/Trabalho-4-bimestre-BD/uploads/photoDefault.jpg'; // Certifique-se de ter esta imagem na pasta uploads
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
</head>

<style>
    * {
        border: 0;
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

    .sidebar {
        background-color: #fff;
        height: 100vh;
        width: 33vh;
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
        margin: 0;
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
        transform-origin: center;
    }

    .list {
        display: flex;
        flex-direction: column;
        margin-top: 2%;
        justify-content: center;
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
        margin-inline: 3%;
        margin-bottom: 7%;
        padding: 2%;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4%;
        text-decoration: none;
        color: #b3b3b3;
        border-radius: 20px;
        transition: background 0.3s, 0.3s ease;
    }

    .produtos:hover,
    .clientes:hover,
    .funcionarios:hover {
        color: #ff7f2a;
        background-color: #ff7f2a6c;
    }

    .produtoimg,
    .clienteimg,
    .funcionarioimg {
        width: 16%;
    }

    .perfil {
        display: flex;
        flex-direction: row;
        align-items: center;
        text-decoration: none;
        margin-inline: 3%;
        padding: 1%;
        border-radius: 20px;
        color: #b3b3b3;
        transition: background 0.3s, 0.3s ease;
    }

    .perfil:hover {
        background-color: #b3b3b34b;
    }


    .perfil img {
        width: 3rem;
        margin-inline: 5%;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .perfil img:hover {
        transform: scale(1.05);
    }


    .cards {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;

    }
</style>

<body>

    <header class="sidebar">
        <div class="logo-marca">
            <h1>Defufu</h1>
            <img src="<?= BASE_URL ?>assets/images/pimentinha.svg" alt="" class="pimentinha">
        </div>
        <div class="middle">
            <div class="list">

                <a class="produtos" href="<?= BASE_URL ?>product/list">
                    <img src="<?= BASE_URL ?>assets/images/produtos.svg" class="produtoimg">
                    Produtos -Listar produtos-
                </a>

                <a class="clientes" href="<?= BASE_URL ?>client/list">
                    <img src="<?= BASE_URL ?>assets/images/cliente.svg" class="clienteimg">
                    Clientes -Listar clientes-
                </a>

                <a class="funcionarios" href="<?= BASE_URL ?>worker/list">
                    <img src="<?= BASE_URL ?>assets/images/funcionario.svg" class="funcionarioimg">
                    Funcionários -Listar Funcionários-
                </a>
                <!--
            <a href="<?= BASE_URL ?>product/create">
                Criar Produtos
            </a>

            <a href="<?= BASE_URL ?>client/create">
                Criar clientes
            </a>

            <a href="<?= BASE_URL ?>worker/create">
                Criar Funcionários
            </a>-->
            </div>


            <a class="perfil" href="<?= BASE_URL ?>index.php?url=profile">
                <img src="<?= $fotoPerfil ?>" alt="Meu Perfil">
                <p>Meu Perfil</p>
            </a>

        </div>

    </header>
    <!-- <div class="cards">
        <div class="pratosCadastrados"> <?php echo $qntProdutos; ?></div>
        <div class="clientesCadastrados"> <?php echo $qntClientes; ?></div>
        <div class="funcionariosCadastrados"> <?php echo $qntFuncionarios; ?></div>
        <div class="precoMedio"><?php echo "R$ " . $precoMedio ?></div>


    </div> -->
</body>

</html>