<?php   /** @var array $workers*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php foreach ($workers as $worker): ?>
        <div class="worker">
            <?php echo $worker['NAME_WORKER']; ?></h3>
            <?php echo $worker['ROLE_WORKER']; ?></h3>
           <?php echo $worker['REGISTRATION_WORKER']; ?></h3>
          
              

            
            <!-- O botão de editar individual de cada prato -->
            <a href="<?= BASE_URL ?>worker/update/<?= $worker['ID_WORKER'] ?>">alter</a>
            <a href="<?= BASE_URL ?>worker/delete/<?= $worker['ID_WORKER'] ?>">delete</a>
    <?php endforeach; ?>
</body>
</html>