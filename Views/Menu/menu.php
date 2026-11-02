<?php
/** @var array $categorias */
/** @var array $produtosPorCategoria */


/*aviso pro intelephense de que essas variaveis existem */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        *{
            border: 0;
            margin: 0;
            padding: 0;
        }
        html, body{
            background-color: olive;
        }


          .logo-marca {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding-right: 25px;
        }

        h1 {
            margin: 0;

            font-family: "Fascinate Inline", system-ui;
            font-size: clamp(2.5rem, 5vw, 5.5rem);

            color: #526832;
            text-align: center;

            line-height: 1.1;
        }

        .pimentinha {
            position: absolute;
            width: 55px;
            height: auto;
            right: -20px;
            bottom: -10px;
            transform: rotate(10deg);
            transform-origin: center;
        }
        header{
            background-color:white;
            min-height: 6rem;
        }

        .produtos{
            display: grid;
             grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 20px;
        }

       

        .card-produto img {
    width: 100%;
    height: 95vh;
    object-fit: cover;
    object-position: center;
}


    </style>
</head>
<body>
    <header>
       <div class="logo-marca">
                <h1>Defufu</h1>

                <img
                    src= "../assets/images/pimentinha.svg"
                    alt=""
                    class="pimentinha"
                >
            </div>

    </header>
    <main class = "corpoPagina">

<?php foreach ($categorias as $categoria): ?> <!-- faça ao percorrer cada categoria da array $categoria sendo $categoria a categoria a ser percorrida agors (indice)-->


    <section class="categoria">

        <h2>
            <?= htmlspecialchars($categoria['NAME_CATEGORY']) ?>
        </h2>

        <div class="produtos">

            <?php
            $idCategoria = $categoria['ID_CATEGORY'];
            ?>

            <?php foreach ($produtosPorCategoria[$idCategoria] as $produto): ?>

                <a 
                          href="<?= BASE_URL ?>product/detail/<?= $produto['ID_PRODUCT'] ?>"
                           class="card-produto"
>
                    <img 
                        src="<?= BASE_URL . htmlspecialchars($produto['PHOTO_PRODUCT']) ?>"
                        alt="<?= htmlspecialchars($produto['NAME_PRODUCT']) ?>"
                    >

                    <h3>
                        <?= htmlspecialchars($produto['NAME_PRODUCT']) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($produto['DESCRIPTION_PRODUCT']) ?>
                    </p>

                    <span>
                        R$ <?= number_format($produto['PRICE_PRODUCT'], 2, ',', '.') ?>
                    </span>

            </a>

            <?php endforeach; ?>

        </div>

    </section>

<?php endforeach; ?>
            </main>




</body>
</html>





