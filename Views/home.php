<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defufu</title>
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Sniglet:wght@400;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
        }

        body {
            background-color: #ff7f2a;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            /* flex-end*/
            align-items: center;
            position: relative;
            background-image: url('assets/images/fundo.png');
            background-repeat: repeat;
            animation: mover 80s linear infinite;
            padding: 2rem;
            overflow-x: hidden;
        }

        @keyframes mover {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: -2000px 0;
            }
        }


        h1 {
            font-family: "Fascinate Inline", system-ui;
            /* tamanho mínimo 4rem, ideal 10vw, tamanho máximo 12rem */
            font-size: clamp(4rem, 10vw, 12rem);
            margin: 0;
            color: darkolivegreen;
            -webkit-text-stroke: 2px darkolivegreen;
            text-shadow: -4px -4px 0 white,
                4px -4px 0 white,
                -4px 4px 0 white,
                4px 4px 0 white;
            ;
            z-index: 10;
            pointer-events: none;
            margin-left: 5vw;
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /*gap: 15%;*/
            width: 100%;
            /*35rem*/
            /*height: 30rem;*/
            max-width: 32rem;
            min-height: 28rem;
            background-color: #fff;
            padding: 2.5rem 2rem;
            border-radius: 2rem;
            border: 1rem solid #A0522D;
            outline: 0.5rem solid #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 10;
            margin-right: 5vw;
        }

        h2 {
            font-family: "Sniglet", system-ui;
            font-weight: 400;
            text-align: center;
            color: #A0522D;
            margin: 0;
            pointer-events: none;
            font-size: clamp(1.3rem, 2.5vw, 1.8rem);
            line-height: 1.3;
        }

        .btns {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-login,
        .btn-create {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            text-decoration: none;
            width: 100%;
            max-width: 24rem;
            padding: 0.8em 1.5em;
            font-family: "Sniglet", system-ui;
            font-size: 1.2rem;
            background-color: darkolivegreen;
            color: #fff;
            border: none;
            border-radius: 0.8rem;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .btn-login:hover,
        .btn-create:hover {
            background-color: #803e1f;
            transform: translateY(-2px);
        }

        @media (max-width: 900px) {
            body {
                flex-direction: column;
                justify-content: center;
                gap: 2rem;
                padding: 2rem 1rem;
            }

            h1 {
                margin-left: 0;
                text-align: center;
                font-size: clamp(3.5rem, 15vw, 6rem);
            }

            .box {
                margin-right: 0;
                width: 90%;
                min-height: auto;
                padding: 2rem 1.5rem;
            }
        }

        .btn-create {
            margin-top: 5%;
        }
    </style>
</head>

<body>

    <h1>Defufu</h1>

    <div class="box">
        <h2>O seu próximo prato favorito está à sua espera. Faça login ou crie a sua conta.</h2>
        <div class="btns">
            <a href="account/login" class="btn-login">Entrar / Fazer Login</a>
            <a href="account/register" class="btn-create">Criar Conta</a>
        </div>
    </div>
</body>

</html>