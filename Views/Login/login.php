<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* #ffd18a */
            background-image:
                url(' /Trabalho-4-bimestre-BD/assets/images/folhacima.png'),
                url('/Trabalho-4-bimestre-BD/assets/images/folhabaixo.png');
            background-position:
                top right,
                bottom left;
            background-repeat: no-repeat;
            background-size: 20% auto, 20% auto;
            padding: 1rem;
            font-family: "Sniglet", system-ui;
            background-color: #e7e7e7;
        }

        .login-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            max-width: 26rem;
            padding: 2.5rem 2rem;
            border-radius: 2rem;
            background-color: #fff;
            border: 0.7rem solid #A0522D;
            outline: 0.2rem solid #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
            width: 85%;
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
            background-color: #556B2F;
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover {
            background-color: #A0522D;
            transform: translateY(-1px);
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

        .error-msg,
        .success-msg {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.6rem;
            font-size: 0.9rem;
            text-align: center;
            box-sizing: border-box;
            margin-bottom: 1rem;
        }

        .error-msg {
            background-color: #F8D7DA;
            color: #842029;
            border: 1px solid #F5C2C7;
        }

        .success-msg {
            background-color: #D1E7DD;
            color: #0F5132;
            border: 1px solid #BADBCC;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem 1rem;
                border-radius: 1.5rem;
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
                    <input type="email" id="email" name="email" >
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" >
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
            </form>
        </div>

        <div class="create-link">
            Ainda não tem uma conta? <a href="/Trabalho-4-bimestre-BD/account/register">Criar conta</a>
        </div>
    </div>
</body>

</html>