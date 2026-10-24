<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defufu</title>
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Sniglet:wght@400;800&display=swap"
        rel="stylesheet">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
        }

        body {
            box-sizing: border-box;
            margin: 0;
            background-color: #ff7f2a;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            background-image: url('assets/images/fundo.png');
            background-repeat: repeat;
            animation: mover 80s linear infinite;
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
            font-size: 12rem;
            margin: 0;
            color: #803e1f;
            -webkit-text-stroke: 2px #fff;
            text-shadow: 4px 4px 0px rgba(0, 0, 0, 0.15);
            z-index: 10;
            position: absolute;
            top: 15%;
            left: 10%;
            pointer-events: none;
        }

        .box {
            display: flex;
            flex-direction: column;
            gap: 15%;
            width: 35rem;
            height: 30rem;
            background-color: #fff;
            margin: 7%;
            margin-right: 11%;
            padding: 2rem 2rem;
            border-radius: 2rem;
            box-sizing: border-box;
            border: 2px solid #A0522D;
        }

        h2 {
            font-family: "Sniglet", system-ui;
            font-weight: 400;
            text-align: center;
            color: #A0522D;
            margin-top: 2;
            pointer-events: none;
            font-size: 2rem;
        }

        .btns {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5%;
        }

        .btn-login,
        .btn-create {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            text-decoration: none;
            width: 90%;
            padding: 0.8em 1.5em;
            font-family: "Sniglet", system-ui;
            font-size: 1.3rem;
            background-color: #A0522D;
            color: #fff;
            border: none;
            border-radius: 0.6rem;
            box-sizing: border-box;
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