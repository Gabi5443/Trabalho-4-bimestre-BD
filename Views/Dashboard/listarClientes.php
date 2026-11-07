<?php   /** @var array $clients */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


  <?php foreach ($clients as $client): ?>
        <div class="product">
            <?php echo $client['NAME_CLIENT']; ?></h3>
            <?php echo $client['CPF_CLIENT']; ?></h3>
           <?php echo $client['NUMBER_CLIENT']; ?></h3>
              

            
            <!-- O botão de editar individual de cada prato -->
            <a href="<?= BASE_URL ?>client/update/<?= $client['ID_CLIENT'] ?>">alter</a>
            <a href="<?= BASE_URL ?>client/delete/<?= $client['ID_CLIENT'] ?>">delete</a>
    <?php endforeach; ?>

</body>
</html>