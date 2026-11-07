<?php   /** @var array $produtos */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio</title>
    <style>
        body {
            background-color: aqua;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['mensagem'] ?>
    </div>

    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>
    
    <?php foreach ($produtos as $produto): ?>
        <div class="product">
            <?php echo $produto['NAME_PRODUCT']; ?></h3>
             <?php echo $produto['PRICE_PRODUCT']; ?></h3>
             <?php echo $produto['DESCRIPTION_PRODUCT']; ?></h3>
             <?php echo $produto['STOCK_PRODUCT']; ?></h3>
              

            
            <!-- O botão de editar individual de cada prato -->
            <a href="<?= BASE_URL ?>product/update/<?= $produto['ID_PRODUCT'] ?>">alter</a>
            <a href="<?= BASE_URL ?>product/delete/<?= $produto['ID_PRODUCT'] ?>">delete</a>
    <?php endforeach; ?>
</body>
</html>