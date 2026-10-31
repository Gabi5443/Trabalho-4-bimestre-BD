<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defufu</title>

    <link href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Manrope:wght@400;500;600;700;800&display=swap"
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
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #F5EFE5;
            background-image: url("assets/images/fundo2.webp");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: "Manrope", sans-serif;
        }

        .boxcentral {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 1000px;
            min-height: 460px;
            background-color: #FFFFFF;

            border-radius: 20px;
            overflow: hidden;

            box-shadow: 0 12px 35px rgba(47, 48, 41, 0.12);
        }

        
        .logo {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 2rem;

            background-color: #FFFFFF;
            text-align: center;
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
            font-size: clamp(3.5rem, 6vw, 6.5rem);

            color: #526832;
            text-align: center;

            line-height: 1.1;
        }

        .pimentinha {
            position: absolute;
            width: 65px;
            height: auto;
            right: -20px;
            bottom: -10px;
            transform: rotate(10deg);
            transform-origin: center;
        }

        .logo p {
            max-width: 300px;
            margin: 1.5rem 0 0;
            font-size: 0.95rem;
            font-weight: 500;
            line-height: 1.6;
            color: #77766D;
            text-align: center;
        }

  
        .box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 3rem 2.5rem;

            background-color: #F8F5EF;
        }

        h2 {
            margin: 0;

            font-size: clamp(1.5rem, 2.5vw, 1.9rem);
            font-weight: 700;
            line-height: 1.3;

            text-align: center;
            color: #2F3029;
        }

        .descricao {
            max-width: 350px;

            margin: 1rem 0 2rem;

            font-size: 0.95rem;
            line-height: 1.6;

            text-align: center;
            color: #77766D;
        }

        .btns {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.9rem;
            width: 100%;
            max-width: 24rem;
        }

        .btn-login,
        .btn-create {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 100%;
            min-height: 52px;

            padding: 0.9rem 1.5rem;

            font-family: "Manrope", sans-serif;
            font-size: 0.95rem;
            font-weight: 700;

            text-decoration: none;
            text-align: center;

            border-radius: 10px;
                transition: background-color 0.15s ease-out,
                transform 0.15s ease-out;

        }

        .btn-login {
            background-color: #526832;
            color: #FFFFFF;
            border: 1px solid #526832;
        }

        .btn-create {
            background-color: transparent;
            color: #526832;
            border: 1px solid #526832;
        }

        .btn-login:hover {
            background-color: #405326;
            transform: translateY(-5px);
            
       
        }

        .btn-create:hover {
            background-color: #EAEDE2;
            transform: translateY(-5px);
            
          
        }

    
        @media (max-width: 768px) {
            body {
                padding: 1.5rem;
            }

            .boxcentral {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .logo {
                padding: 2.5rem 1.5rem 1rem;
            }

            h1 {
                font-size: clamp(3.5rem, 13vw, 5rem);
            }

            .pimentinha {
                width: 55px;
                right: -20px;
                bottom: -15px;
            }

            .logo p {
                margin-top: 1rem;
                margin-bottom: 0;
            }

            .box {
                padding: 2rem 1.5rem 2.5rem;
            }

            h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 400px) {
            body {
                padding: 1rem;
            }

            .boxcentral {
                border-radius: 16px;
            }

            .logo {
                padding-top: 2rem;
            }

            h1 {
                font-size: 3.5rem;
            }

            .pimentinha {
                width: 45px;
                right: -15px;
                bottom: -12px;
            }

            .box {
                padding: 1.5rem 1.2rem 2rem;
            }
        }
    </style>
</head>

<body>

    <main class="boxcentral">
        <section class="logo">
            <div class="logo-marca">
                <h1>Defufu</h1>

                <img
                    src="assets/images/pimentinha.svg"
                    alt=""
                    class="pimentinha"
                >
            </div>

            <p>
                Comida defumada, regional e afetiva.
            </p>

        </section>
        <section class="box">

            <h2>Bem-vindo ao Defufu!</h2>

            <p class="descricao">
                O seu próximo prato favorito está à sua espera.
                Acesse sua conta para continuar.
            </p>

            <div class="btns">

                <a href="account/login" class="btn-login">
                    Entrar / Fazer Login
                </a>

                <a href="account/register" class="btn-create">
                    Criar Conta
                </a>

            </div>
        </section>
    </main>
</body>
</html>