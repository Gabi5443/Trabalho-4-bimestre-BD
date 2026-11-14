<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Cliente</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .create {
            display: flex;
            color: #556B2F;
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
            background: radial-gradient(circle, #ff7f2ad5, #eee8dc);
            font-family: "Manrope", sans-serif;
        }

        .box {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 30rem;
            padding: 2rem 2rem;
            margin: 3%;
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

        h1 {
            color: #556B2F;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 1.2rem;
        }

        .inside {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .create-card {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .create {
            font-weight: 700;
            font-size: 1.7rem;
            margin-bottom: 2%;
        }

        form {
            width: 90%;
        }

        .formGroup {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.0rem;
        }

        .formGroup label,
        h3 {
            color: #556B2F;
            font-size: 0.95rem;
            margin-bottom: 0.4rem;
            font-weight: 700;
            align-items: flex-start;
        }

        .formGroup input {
            width: 100%;
        }

        [name="NAME_CLIENT"],
        [name="CPF_CLIENT"],
        [name="NUMBER_CLIENT"] {
            border-radius: 20px;
            border: 1.5px solid #556B2F;
            width: 90%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: #333333;
            background-color: #FAFAFA;
            box-shadow: 0 0 8px rgba(226, 114, 91, 0.15);
            transition: border 0.2s ease;
        }

        [name="NAME_CLIENT"]:focus,
        [name="CPF_CLIENT"]:focus,
        [name="NUMBER_CLIENT"]:focus {
            border: 2px solid #556B2F;
            outline: none;
        }


        .btn-submit {
            display: flex;
            justify-content: center;
            justify-self: center;
            align-items: center;
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
            background-color: #405326;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .box-photo {
                gap: 2rem;
            }


        }

        #arquivo-upload {
            display: none;
        }

        .formGroup label.botaoPer {

            background: color-mix(in srgb, #ff7f2ad5 20%, #eee8dc);
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            color: #556B2F;
            padding: 5px 20px;
            border-radius: 12px;
            border: 1.5px solid #556B2F;
            font-family: sans-serif;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            align-items: center;
            justify-content: center;
            justify-items: center;

        }

        .formGroup label.botaoPer:hover {
            background: color-mix(in srgb, #ff7f2ad5 40%, #eee8dc);
            transform: translateY(-2px);

        }
    </style>
</head>

<body>
    <div class="box">
        <div class="create-card">
            <div class="inside">

                <div class="create">Criar Cliente</div>
                <form action="/Trabalho-4-bimestre-BD/client/create" method="POST" enctype="multipart/form-data">
                    <div class="formGroup">
                        <label for="Nome">Nome:</label>
                        <input type="text" name="NAME_CLIENT">
                    </div>


                    <div class="formGroup">
                        <label for="Descrição">CPF:</label>
                        <input type="text" name="CPF_CLIENT">
                    </div>


                    <div class="formGroup">
                        <label for="Preço">Telefone:</label>
                        <input type="number" name="NUMBER_CLIENT">
                    </div>


                    <!-- aqui vou deixar pra vc colocar o input da foto ficar bonitinho igual do create de produto -->

                   <div class="formGroup">
                        <label for="arquivo-upload" class="botaoPer"> Escolha a foto </label>
                        <input type="file" name="PHOTO_PRODUCT" accept="image/* " required id="arquivo-upload">

                    </div>

                    <button type="submit" class="btn-submit">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>