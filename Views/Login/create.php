<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
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
            /*#dfdede*/
        }

        .create-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
            max-width: 28rem;
            padding: 2rem 2rem;
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

        .create {
            text-align: center;
            color: #556B2F;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 1.2rem;
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

        [name="name"],
        [name="email"],
        [name="password"] {
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

        [name="name"]:focus,
        [name="email"]:focus,
        [name="password"]:focus {
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

        .login-link {
            text-align: center;
            margin-top: 1.2rem;
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
            .create-card {
                padding: 1.5rem 1rem;
                border-radius: 1.5rem;
            }

            [name="name"],
            [name="email"],
            [name="password"],
            [name="admin_code"],
            .btn-submit,
            .form-group label {
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <div class="create-card">
        <div class="inside">
            <div class="create">Criar Conta</div>
            <form action="/Trabalho-4-bimestre-BD/account/register" method="POST">

                <?php if (isset($erroMensagem)): ?>
                    <div class="alert-error" style="color: red; margin-bottom: 15px;">
                        <?= htmlspecialchars($erroMensagem); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" >
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" >
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="senha" name="password" >
                </div>


                <button type="submit" class="btn-submit">Criar minha conta</button>
            </form>

            <div class="login-link">
                Já tem uma conta? <a href="/Trabalho-4-bimestre-BD/account/login">Faça login</a>
            </div>
        </div>
</body>

</html>