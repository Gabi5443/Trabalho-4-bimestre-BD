<?php /** @var array $produto */ ?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="detalhe-produto">

    <div class="imagem-produto">
        <img
            src="<?= BASE_URL . htmlspecialchars($produto['PHOTO_PRODUCT']) ?>"
            alt="<?= htmlspecialchars($produto['NAME_PRODUCT']) ?>"
        >
    </div>

    <div class="informacoes-produto">

        <h1><?= htmlspecialchars($produto['NAME_PRODUCT']) ?></h1>

        <p>
            <?= htmlspecialchars($produto['DESCRIPTION_PRODUCT']) ?>
        </p>

        <span class="preco">
            R$ <?= number_format($produto['PRICE_PRODUCT'], 2, ',', '.') ?>
        </span>

    </div>

</div>
    
</body>
</html>