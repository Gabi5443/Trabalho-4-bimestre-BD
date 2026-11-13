<?php   /** @var array $clients */ ?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            background-color: #ffefe5;
            font-family: Arial, sans-serif;
            padding: 2rem;
            margin: 0;
        }

        .tabela {
            width: 90%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            background-color: white;
            border-radius: 0.7rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .tabela th,
        .tabela td {
            padding: 1.2rem;
            text-align: left;
        }

        .tabela th {
            background-color: #ff7f2ad5;
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
        }



        .tabela td {
            border-bottom: 1px solid #eee8dc;
            color: #556b2f;
            ;
            font-size: 0.9rem;
        }

        .tabela tbody tr:last-child td {
            border-bottom: none;
        }

        .tabela tbody tr:hover {
            background-color: #faf7f0;
        }

        /* Coluna de preço */
        .tabela td:nth-child(2) {
            white-space: nowrap;
            font-weight: 600;
        }

        /* Coluna de estoque */
        .tabela td:nth-child(4) {
            text-align: center;
        }

        /* Botões */
        .botoes {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .botoes a {
            display: block;
            text-decoration: none;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .botaoAlter,
        .botaoDelete {
            padding: 0.6rem 0.9rem;
            border-radius: 0.35rem;
            transition: 0.2s ease;
            text-align: center;
        }

        .botaoAlter {
            background-color: #ffbe33;
        }

        .botaoDelete {
            background-color: #e92f3b;
        }

        .botaoDelete a {
            color: white;
        }

        .botaoAlter:hover,
        .botaoDelete:hover {
            filter: brightness(0.92);
            transform: translateY(-1px);
        }

        /* Responsividade */
        @media (max-width: 700px) {
            body {
                padding: 0.5rem;
                justify-content: flex-start;
            }

            .tabela {
                width: 100%;
                margin-top: 10px;
            }

            .tabela th,
            .tabela td {
                padding: 0.65rem 0.4rem;
                font-size: 0.72rem;
            }

            .botoes {
                flex-direction: column;
                gap: 6px;
            }

            .botaoAlter,
            .botaoDelete {
                padding: 0.45rem;
                width: 100%;
            }

            .botoes a {
                font-size: 0.7rem;
            }
        }

        .fotoClient {
            width: 5rem;
            height: 5rem;
            object-fit: cover;
            border-radius: 1rem;
            border: 2px solid #eee8dc;
            display: block;
        }
    </style>
</head>

<body>
    <table class="tabela">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Foto</th>
                <th></th>


            </tr>
        </thead>

        <tbody>




            <?php foreach ($clients as $client): ?>



                <tr>
                    <td> <?php echo ($client['NAME_CLIENT']) ?> </td>
                    <td> <?php echo ($client['CPF_CLIENT']) ?> </td>
                    <td> <?php echo ($client['NUMBER_CLIENT']) ?> </td>



<td>
    <?php
    $fotoCliente = !empty($client['PHOTO_CLIENT'])
        ? BASE_URL . htmlspecialchars($client['PHOTO_CLIENT'], ENT_QUOTES, 'UTF-8')
        : BASE_URL . 'uploads/photoDefault.jpg';
    ?>

    <img 
        src="<?= $fotoCliente ?>"
        alt="<?= htmlspecialchars($client['NAME_CLIENT'], ENT_QUOTES, 'UTF-8') ?>"
        class="fotoClient"
    >
</td>



                    <td>
                        <div class="botoes">
                            <div class="botaoAlter">
                                <a href="<?= BASE_URL ?>client/update/<?= $client['ID_CLIENT'] ?>">
                                    Alterar
                                </a>

                            </div>
                            <div class="botaoDelete">
                                <a href="<?= BASE_URL ?>client/delete/<?= $client['ID_CLIENT'] ?>"
                                    onclick="return confirm('Deseja realmente excluir este cliente?')">
                                    Excluir
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

</body>

</html>