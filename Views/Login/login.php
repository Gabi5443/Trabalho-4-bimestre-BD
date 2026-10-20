<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* #ffd18a */
            background-image:
                url('../../assets/images/folha-cima.png'),
                url('../../assets/images/folha-baixo.png');
            background-position:
                top right,
                bottom left;
            background-repeat: no-repeat;
            background-size: 20% auto, 20% auto;
        }

        .login-card {
            text-align: center;
            width: 30%;
            height: 40%;
            border-radius: 7%;
            background-color: #fff;
            font-family: "Sniglet", system-ui;
            border: 2px solid #A0522D;
        }

        .form-group {
            margin-bottom: 10%;
        }

        .inside {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login {
            text-align: center;
            color: #A0522D;
            font-family: "Sniglet", system-ui;
            font-weight: 800;
            margin: 5%;
            font-size: 200%;
        }

        [name="email"],
        [name="senha"] {
            box-shadow: none;
            border-radius: 20px;
            border: 1.5px solid #A0522D;
            width: 70%;
            padding: 7px 16px;
            font-size: 15px;
            color: #333333;
            background-color: #FAFAFA;
            box-sizing: border-box;
            box-shadow: 0 0 8px rgba(226, 114, 91, 0.25);
        }

        [name="email"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        [name="senha"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        .btn-submit {
            padding: 4% 30%;
            font-family: "Sniglet", system-ui;
            font-weight: bold;
            border: none;
            background-color: #A0522D;
            color: #fff;
            border-radius: 10px;
        }

        .create-link {
            margin-top: 5%;

        }

        a:visited,
        a:link {
            color: #A0522D;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- menssagem de feedback da controller -->
        <?php if (isset($_GET['erro'])): ?>
            <div class="msg error-msg">E-mail ou senha inválidos!</div>
        <?php elseif (isset($_GET['sucesso'])): ?>
            <div class="msg success-msg">Conta criada com sucesso! Faça login.</div>
        <?php endif; ?>

        <div class="inside">
            <div class="login">Login</div>
          <form action="account/login" method="POST">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button type="submit" class="btn-submit">Entrar</button>
            </form>
        </div>

        <div class="create-link">
            Ainda não tem uma conta? <a href="create.php">Criar conta</a>
        </div>
    </div>
</body>

</html>