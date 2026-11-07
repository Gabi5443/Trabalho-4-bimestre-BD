<?php   /** @var array $produtos */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <style>
       .cardProduto {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
}

.product {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 15px;
    border: 1px solid black;
    border-radius: 8px;
    width: 350px;
}

.product p {
    margin: 0;
}

.acoes {
    display: flex;
    gap: 10px;
}
    </style>

    
</head>
<body>
   
    
    <?php foreach ($produtos as $produto): ?>
        
<div class="cardProduto">
    <div class="product">
        <p>Nome do Produto: <?= $produto['NAME_PRODUCT'] ?></p>
        <p>Preço: <?= $produto['PRICE_PRODUCT'] ?></p>
        <p>>Descrição: <?= $produto['DESCRIPTION_PRODUCT'] ?></p>
        <p>Estoque: <?= $produto['STOCK_PRODUCT'] ?></p>

        <div class="acoes">
            <a href="<?= BASE_URL ?>product/update/<?= $produto['ID_PRODUCT'] ?>">Alterar</a>
            <a href="<?= BASE_URL ?>product/delete/<?= $produto['ID_PRODUCT'] ?>">Excluir</a>
        </div>
    </div>
</div>

    <?php endforeach; ?>
</body>
</html>