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


<body>


<header>
    
</header>
    <div class="cards">
        <div class="PratosCadastrados"> <?php echo $qntProdutos; ?></div>
        <div class="ClientesCadastrados"> <?php echo $qntClientes; ?></div>
        <div class="FuncionariosCadastrados"> <?php echo $qntFuncionarios; ?></div>
        <div class="precoMedio"><?php echo "R$ " . $precoMedio ?></div>


    </div>
</body>
</html>