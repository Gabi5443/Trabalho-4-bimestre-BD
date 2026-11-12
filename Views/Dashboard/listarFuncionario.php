<?php   /** @var array $workers*/ ?>


<?php
// Define a foto padrão caso o utilizador não tenha escolhido nenhuma
$fotoPerfil = !empty($_SESSION['photo'])
    ? '/Trabalho-4-bimestre-BD/uploads/' . htmlspecialchars($_SESSION['photo'])
    : '/Trabalho-4-bimestre-BD/uploads/photoDefault.jpg'; // Certifique-se de ter esta imagem na pasta uploads
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Funcionário</title>
    <style>
  
* {
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    background-color:#F3F3F0;
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.07);
}

.tabela th,
.tabela td {
    padding: 1.2rem;
    text-align: left;
}

.tabela th {
    background-color: #556b2f;
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
}



.tabela td {
    border-bottom: 1px solid #eee8dc;
    color: #556b2f;;
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
    color: #556b2f;
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

 .fotoWorker {
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
                <th>Nome do Funcionário</th>
                <th>Cargo</th>
                <th>Registro</th>
                <th></th>
                <th></th>
                
            </tr>
        </thead>

        <tbody>
    
<?php foreach ($workers as $worker): ?>
    <tr>
        <div class="worker">
          <td><?php echo $worker['NAME_WORKER']; ?></td>
           <td> <?php echo $worker['ROLE_WORKER']; ?></td>
           <td><?php echo $worker['REGISTRATION_WORKER']; ?></td>


           <td>
  
       <img src="<?= $fotoPerfil ?>" alt="Meu Perfil"
        alt="<?= htmlspecialchars($worker['NAME_WORKER']) ?>"
        class="fotoWorker"
    >
</td>
          
              

            
          <td>
                        <div class="botoes">
                        <div class="botaoAlter">
                            <a href="<?= BASE_URL ?>worker/update/<?= $worker['ID_WORKER'] ?>">
                                Alterar
                            </a>

                            </div>
                            <div class="botaoDelete">
                            <a href="<?= BASE_URL ?>worker/delete/<?= $worker['ID_WORKER'] ?>"
                               onclick="return confirm('Deseja realmente excluir este funcionário?')">
                                Excluir
                            </a>
                        </div>
                        </div>
                    </td>

    </tr>
    <?php endforeach; ?>
</body>
</html>