<?php /** @var array $produto */ ?>
<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
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
            background-color: #ffbe33;
            font-family: "Manrope", sans-serif;

            display: flex;
            justify-content: center;
        }

        .box {
            background-color: #fff;
            border-radius: 20px;
            margin: 2rem ;
            padding: 1.5rem 1.5rem 2.5rem 1.5rem;
            width: 100%;
            max-width: 1100px;
            min-height: fit-content;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-areas:
                "imagem info"
                "botoes botoes";
            gap: 5%;
            outline: 2px solid #ffbe33;
            outline-offset: -15px;
        }

        .imagem-produto {
            grid-area: imagem;
            width: 80%;
            justify-self: center;
            margin-top: 4%;
        }

        .imagem-produto img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease;
        }

        .imagem-produto img:hover {
            transform: translateY(-9px);
        }

        .infoProduto {
            grid-area: info;
            margin-top: 4%;
            pointer-events: none;
        }

        h2 {
            color: #ff7f2a;
            font-size: clamp(1.5rem, 2vw, 3rem);
        }

        p {
            color: #b3b3b3;
            font-size: clamp(1rem, 1vw, 1.5rem);
            margin-top: 3%;
        }

        h3 {
            color: #8d8c8c;
            font-size: clamp(1rem, 1vw, 1.5rem);
            margin-top: 20%;
        }

        .botoes {
            grid-area: botoes;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 2rem;
            
        }

        .bottomPedir {
            background-color: #ffbe33;
            color: white;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 45px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s, 0.3s ease;
        }

        .bottomPedir:hover {
            transform: translateY(-2px);
            background-color: #f1ae1d;
        }

        .bottomVoltar {
            background-color: #e92f3be5;
            color: white;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 45px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s, 0.3s ease;
        }

        .bottomVoltar:hover {
            transform: translateY(-2px);
            background-color: #e92f3a;
        }

        @media (max-width: 850px) {
            .box {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "imagem"
                    "info"
                    "botoes";
                padding: 1.2rem 1.2rem 2rem 1.2rem;
            }

            .infoProduto {
                padding: 0 1rem; 
            }

            h3 {
                margin-top: 10%;
            }

            .botoes {
                flex-direction: column;
                gap: 5%;
                padding: 0 1rem; 
                align-items: center;
                justify-content: unset;
            }

            .bottomPedir,.bottomVoltar {
                width: 100%;
            }

        }
    </style>
</head>

<body>
    <div class="box">

        <div class="imagem-produto">
            <img src="<?= BASE_URL . htmlspecialchars($produto['PHOTO_PRODUCT']) ?>"
                alt="<?= htmlspecialchars($produto['NAME_PRODUCT']) ?>">
        </div>

        <div class="infoProduto">

            <h2>
                <?= htmlspecialchars($produto['NAME_PRODUCT']) ?>
            </h2>

            <p>
                R$ <?= number_format($produto['PRICE_PRODUCT'], 2, ',', '.') ?>
            </p>

            <h3>
                <?= htmlspecialchars($produto['DESCRIPTION_PRODUCT']) ?>
            </h3>

        </div>
        <div class="botoes">
            <a href="<?= BASE_URL ?>menu" class="bottomVoltar">Voltar</a>
            <a href="<?= BASE_URL ?>product/pedir/<?= $produto['ID_PRODUCT'] ?>"class="bottomPedir">Pedir</a>
        </div>
    </div>

</body>

</html>