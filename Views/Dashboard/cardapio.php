<?php
    // Exemplo de como você busca os produtos no banco (ajuste conforme sua conexão)
    $conexao = new PDO("mysql:host=localhost;dbname=RESTAURANT", "root", "");
    $resultado = $conexao->query("SELECT * FROM PRODUCT");
    $produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

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
    <h1>Cardápio</h1>

    <?php foreach ($produtos as $produto): ?>
        <div class="product">
            <h3><?php echo $produto['NAME_PRODUCT']; ?></h3>
            
            <!-- O botão de editar individual de cada prato -->
            <a href="index.php?pagina=editar-produto&id=<?php echo $produto['ID_PRODUCT']; ?>" class="btn-editar">Editar</a>
        </div>
    <?php endforeach; ?>
</body>
</html>