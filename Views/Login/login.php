<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fascinate+Inline&family=Manrope:wght@400;500;600;700;800&display=swap"
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
            height: 100vh;
            overflow: hidden;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("../assets/images/fundo2.webp");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: "Manrope", sans-serif;
        }


        .pimentinha {
            position: absolute;
            width: 25%;
            height: auto;
            right: -20px;
            bottom: -12px;
            z-index: 10;
            pointer-events: none;
        }

        .login-card {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 90%;
            max-width: 26rem;
            padding: 2.5rem 2rem;
            border-radius: 2rem;
            background-color: #F8F5EF;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
            animation: surgirNaTela 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes surgirNaTela {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .inside {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login {
            text-align: center;
            color: #556B2F;
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
        }

        .form-group label {
            color: #556B2F;
            font-size: 0.95rem;
            margin-bottom: 0.4rem;
            font-weight: 600;
            align-items: flex-start;
        }

        .form-group input {
            width: 100%;
        }


        [name="email"],
        [name="senha"] {
            border-radius: 20px;
            border: 1.5px solid #556B2F;
            width: 100%;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            color: #333333;
            background-color: #FAFAFA;
            box-shadow: 0 0 8px rgba(226, 114, 91, 0.15);
            transition: border 0.2s ease;
        }

        [name="email"]:focus,
        [name="senha"]:focus {
            border: 2px solid #556B2F;
            outline: none;
        }

        .btn-submit {
            width: 85%;
            padding: 0.8rem;
            font-family: "Sniglet", system-ui;
            font-weight: bold;
            font-size: 1.1rem;
            border: none;
            background-color: #526832;
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover {
            background-color: #405326;
            transform: translateY(-2px);
        }

        .create-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
            color: #555;
        }

        a:visited,
        a:link {
            color: #556B2F;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            body {
                justify-content: center;
                align-items: center;
            }

            .login-card {
                width: 90%;
                padding: 1.5rem 1rem;
            }

            .pimentinha {
                right: -17px;
            }

            [name="email"],
            [name="senha"],
            .btn-submit,
            .form-group label {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- menssagem de feedback da controller -->
        <div class="inside">
            <div class="login">Login</div>
            <form action="/Trabalho-4-bimestre-BD/account/login" method="POST">

                <?php if (isset($erroMensagem)): ?>
                    <div class="alert-error" style="color: red; margin-bottom: 15px;">
                        <?= htmlspecialchars($erroMensagem); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha">
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
            </form>
        </div>

        <div class="create-link">
            Ainda não tem uma conta? <a href="/Trabalho-4-bimestre-BD/account/register">Criar conta</a>
        </div>
        <img src="../assets/images/pimentinha.svg" alt="" class="pimentinha">
    </div>
</body>

</html>