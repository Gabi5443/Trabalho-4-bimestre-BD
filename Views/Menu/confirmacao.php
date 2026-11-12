<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5%;
            outline: 2px solid #ffbe33;
            outline-offset: -15px;
            flex-direction: column;
        }

     
.mensagem{
    color: #ff7f2a;
            font-size: clamp(2.5rem, 2vw, 3rem);
            display: flex;
            align-items: center;
            justify-content: center;

}
       


        .botoes {
           
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 2rem;
            
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

        <div class="confirmacao">
            <h1 class="mensagem">Seu pedido está a caminho!</h1>
        </div>
        <div class="botoes">
            <a href="<?= BASE_URL ?>menu" class="bottomVoltar">Voltar</a>
           
        </div>
    </div>

</body>

</html>
</body>
</html>