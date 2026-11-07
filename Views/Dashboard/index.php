<?php
/** @var int $qntProdutos */
/** @var int $qntClientes */
/** @var int $qntFuncionarios */
/** @var int $precoMedio */


/*aviso pro intelephense de que essas variaveis existem */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    *{
        margin: 0;
        padding: 0;
        
    }


    .cards{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;

    }


</style>
<body>


<header>
<a href="<?= BASE_URL ?>product/list">
    Listar produtos
</a>


<a href="<?= BASE_URL ?>client/list">
    Listar clientes
</a>

<a href="<?= BASE_URL ?>product/create">
  Criar Produtos
</a>

<a href="<?= BASE_URL ?>worker/list">
  Listar Funcionários
</a>

<a href="<?= BASE_URL ?>client/create">
  Criar clientes
</a>

<a href="<?= BASE_URL ?>worker/create">
  Criar Funcionários
</a>



</header>
    <div class="cards">
        <div class="pratosCadastrados"> <?php echo $qntProdutos; ?></div>
        <div class="clientesCadastrados"> <?php echo $qntClientes; ?></div>
        <div class="funcionariosCadastrados"> <?php echo $qntFuncionarios; ?></div>
        <div class="precoMedio"><?php echo "R$ " . $precoMedio ?></div>


    </div>
</body>
</html>