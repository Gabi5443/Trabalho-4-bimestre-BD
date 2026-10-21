<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defufu</title>
    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Sniglet:wght@400;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            box-sizing: 0;
            margin: 0;
            background-color: #ff7f2a;
            display: flex;
            flex-direction: row;
            justify-content: space-between;

        }

        h1 {
            font-family: "Fascinate Inline", system-ui;
            font-size: 10rem;
            margin-left: 7%;
        }

        .box {
            display: flex;
            flex-direction: column;
            gap: 15%;
            width: 28rem;
            height: 25rem;
            background-color: #fff;
            margin: 7%;
            margin-right: 15%;
            padding: 2rem 2rem;
            border-radius: 2rem;
        }

        h2 {
            font-family: "Sniglet", system-ui;
            font-weight: 400;
            text-align: center;
            color: #A0522D;
            margin-top: 2;
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
            font-size: 1.1rem;
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