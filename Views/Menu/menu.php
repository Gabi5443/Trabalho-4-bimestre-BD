<?php
/** @var array $categorias */
/** @var array $produtosPorCategoria */

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
    <title>Menu</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            border: 0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
            background-color: #ffbe33;
            font-family: "Manrope", sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            width: 100%;
            height: auto;
        }

        .first {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2%;
        }

        .perfil img {
            width: 5rem;
            height: 5rem;
            margin-top: 20%;
            margin-right: 50%;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .perfil img:hover {
            transform: scale(1.05);
        }

        .logo-marca {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding-right: 25px;
            pointer-events: none;
            margin-left: 3%;
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

        .nav-links {
            display: flex;
            gap: 3rem;
            align-items: center;
            justify-content: center;
        }

        .nav-links a {
            text-decoration: none;
            color:  #556b2f;
            font-weight: 700;
            font-size: 1.3rem;
            position: relative;
            padding-bottom: 1%;
            transition: color 0.3s;
            white-space: nowrap;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #e92f3be5;
            border-radius: 2px;
            transition: width 0.3s ease-in-out;
        }

        .nav-links a:hover::after,
        .nav-links a.ativo::after {
            width: 100%;
        }

        .nav-links a:hover,
        .nav-links a.ativo {
            color: #e92f3be5;
        }

        .perfil {
            margin-right: 3%;
        }

        .corpoPagina {
            background-color: #fff;
            border-radius: 20px;
            margin: 2rem;
            padding: 2rem;
            overflow: hidden;
        }

        .categoria-com-espaco {
            margin-top: 3rem;
        }

        .categoriaTitle {
            color: #556b2f;
            font-weight: 700;
            font-size: 3rem;
            pointer-events: none;
            align-items: center;
        }

        .produtos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
            padding: 0 2%;
        }

        .card-produto {
            height: auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .card-produto:hover {
            transform: translateY(-9px);
        }

        .card-produto img {
            width: 100%;
            height: 60%;
            border-radius: 10px;
            object-fit: cover;
            object-position: center;
        }

        h2,
        p,
        h3 {
            margin-top: 8px;
            font-weight: 700;
        }

        p {
            color: #b3b3b3;
            font-size: clamp(1rem, 1rem, 1.2rem)
        }

        h3 {
            color: #8d8c8c;
            font-size: clamp(1rem, 1rem, 1.2rem)
        }

        h2 {
            color: #e92f3be5;
            font-size: clamp(1.2rem, 1.2rem, 1.5rem)
        }


        @media (max-width: 768px) {

            .logo-marca {
                margin-left: 5%;
                align-items: flex-start;
            }

            .pimentinha {
                right: 13px;
                bottom: -8px;
            }

            .perfil {
                margin-right: 5%;
                justify-self: end;
            }

            .perfil img {
                width: 4rem;
                height: 4rem;
            }

            .nav-links {
                display: flex;
                justify-content: stretch;
                overflow-x: auto;
                white-space: nowrap;
                gap: 1rem;
                margin-top: 3%;
                padding: 5%;

            }

            .nav-links a {
                color: #556b2f;
            }

            .corpoPagina {
                margin: 1rem;
            }

            .card-produto {
                overflow: hidden;
            }


        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="first">
            <div class="logo-marca">
                <h1>Defufu</h1>
                <img src="<?= BASE_URL ?>assets/images/pimentinha.svg" alt="" class="pimentinha">
            </div>

            <div class="perfil">
                <a href="<?= BASE_URL ?>index.php?url=profile">
                    <!-- Exibe a imagem redonda como botão redirecionando para o perfil -->
                    <img src="<?= $fotoPerfil ?>" alt="Meu Perfil">
                </a>
            </div>
        </div>

        <div class="nav-links">
            <?php foreach ($categorias as $categoria): ?>
                <!-- Cria o link dinâmico apontando para o ID da categoria na mesma página -->
                <a href="<?= BASE_URL ?>menu#cat-<?= $categoria['ID_CATEGORY'] ?>">
                    <?= htmlspecialchars($categoria['NAME_CATEGORY']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </header>

    <main class="corpoPagina">

        <?php $index = 0;
        foreach ($categorias as $categoria): ?>
            <?php
            $idCategoria = $categoria['ID_CATEGORY'];
            // Se o índice for maior que 0 (ou seja, a partir de Entradas), adiciona a classe de espaçamento
            $classeEspaco = ($index > 0) ? 'categoria-com-espaco' : '';
            ?>

            <!-- Atribuímos um ID único baseado na categoria e a classe condicional -->
            <section id="cat-<?= $idCategoria ?>" class="categoria <?= $classeEspaco ?>">

                <div class="categoriaTitle">
                    <?= htmlspecialchars($categoria['NAME_CATEGORY']) ?>
                </div>

                <div class="produtos">
                    <?php if (!empty($produtosPorCategoria[$idCategoria])): ?>
                        <?php foreach ($produtosPorCategoria[$idCategoria] as $produto): ?>

                            <a href="<?= BASE_URL ?>product/detail/<?= $produto['ID_PRODUCT'] ?>" class="card-produto">
                                <img src="<?= BASE_URL . htmlspecialchars($produto['PHOTO_PRODUCT']) ?>"
                                    alt="<?= htmlspecialchars($produto['NAME_PRODUCT']) ?>">

                                <p>
                                    R$ <?= number_format($produto['PRICE_PRODUCT'], 2, ',', '.') ?>
                                </p>
                                <h3>
                                    <?= htmlspecialchars($produto['DESCRIPTION_PRODUCT']) ?>
                                </h3>
                                <h2>
                                    <?= htmlspecialchars($produto['NAME_PRODUCT']) ?>
                                </h2>


                            </a>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #2F3029; font-weight: 600;">Nenhum produto cadastrado nesta categoria ainda.</p>
                    <?php endif; ?>
                </div>

            </section>

            <?php $index++; endforeach; ?>
    </main>
</body>

</html>