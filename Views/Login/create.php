<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar-se</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image:
                url('../../assets/images/folha-cima.png'),
                url('../../assets/images/folha-baixo.png');
            background-position:
                top right,
                bottom left;
            background-repeat: no-repeat;
            background-size: 20% auto, 20% auto;
        }

        .create-card {
            text-align: center;
            width: 30%;
            height: 60%;
            border-radius: 7%;
            background-color: #fff;
            font-family: "Sniglet", system-ui;
            border: 2px solid #A0522D;
        }

        .form-group {
            
            margin:7%;
        }

        .inside {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .create {
            text-align: center;
            color: #A0522D;
            font-family: "Sniglet", system-ui;
            font-weight: 800;
            margin: 5%;
            font-size: 200%;
        }

        [name="name"],
        [name="email"],
        [name="password"] {
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

        [name="admin_code"] {
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
            margin-top: 2%;
        }

        [name="name"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        [name="email"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        [name="password"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        [name="admin_code"]:focus {
            border: 2px solid #A0522D;
            outline: none;
        }

        .btn-submit {
            padding: 3% 20%;
            font-family: "Sniglet", system-ui;
            font-weight: bold;
            border: none;
            background-color: #A0522D;
            color: #fff;
            border-radius: 10px;
            font-size: 100%;
        }

        .login-link {
            margin: 2.5%;
             font-size: 90%;
        }
            
    

        a:visited,
        a:link {
            color: #A0522D;
        }
    </style>
</head>

<body>
    <div class="create-card">

        <!-- mensagem de erro caso o cadastro falhe -->
       <?php if (!empty($erroMensagem)): ?>
    <div style="background-color: #ffe6e6; color: #d9534f; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        <?php echo $erroMensagem; ?>
    </div>
<?php endif; ?>

        <!-- o formulário envia os dados via POST para o controller na ação de create -->
        <form action="/Trabalho-4-bimestre-BD/account/register" method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
            </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="senha" name="password" required>
                </div>

                <div class="form-group">
                    <label for="admin_code">Senha Universal (Apenas para Funcionários):</label>
                    <input type="password" id="admin_code" name="admin_code"
                        placeholder="Deixe em branco se for cliente">
                </div>
    
        <button type="submit" class="btn-submit">Criar minha conta</button>
        </form>

             <div class="login-link">
    Já tem uma conta? <a href="/Trabalho-4-bimestre-BD/account/login">Faça login!</a>
             </div>

       

</body>

</html>