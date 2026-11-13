<?php
/** @var array $produto*/
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>



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
            max-width: 28rem;
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

        .formEdit {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 90%;
        }

        .formGroup {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
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


        .box-photo {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 3rem;
            color: #556B2F;
            font-size: 2rem;
            margin-bottom: 0.10rem;
            font-weight: 600;
        }

        .box-photo img {
            border-radius: 20px;
        }

        [name="NAME_PRODUCT"],
        [name="DESCRIPTION_PRODUCT"],
        [name="PRICE_PRODUCT"],
        [name="STOCK_PRODUCT"] {
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

        [name="NAME_PRODUCT"]:focus,
        [name="DESCRIPTION_PRODUCT"]:focus,
        [name="PRICE_PRODUCT"]:focus,
        [name="STOCK_PRODUCT"]:focus {
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
    </style>

</head>

<body>
    <div class="box">
        <div class="formEdit">
            <form method="POST" action="<?= BASE_URL ?>product/update/<?= $produto['ID_PRODUCT'] ?>"
                enctype="multipart/form-data">
                <div class="formGroup">
                    <label for="Nome">Nome:</label>
                    <input type="text" name="NAME_PRODUCT">
                </div>


                <div class="formGroup">
                    <label for="Descrição">Descrição:</label>
                    <input type="text" name="DESCRIPTION_PRODUCT">
                </div>


                <div class="formGroup">
                    <label for="Preço">Preço:</label>
                    <input type="number" name="PRICE_PRODUCT">
                </div>


                <div class="formGroup">
                    <label for="Estoque">Quantidade em Estoque:</label>
                    <input type="number" name="STOCK_PRODUCT">
                </div>


                <div class="formGroup">
                    <label for="Foto">Foto</label>
                    <input type="file" name="PHOTO_PRODUCT" accept="image/* ">
                </div>

                <button type="submit" class="btn-submit">Salvar alterações</button>


            </form>
        </div>
    </div>

</html>