<?php
    $idProduto = $_GET['id'] ?? null;

    if ($idProduto) {
        // 2. Faz a consulta correta no banco usando o PHP (PDO ou MySQLi)
        // Exemplo com PDO:
        $conexao = new PDO("mysql:host=localhost;dbname=RESTAURANT", "root", "");
        $stmt = $conexao->prepare("SELECT * FROM PRODUCT WHERE ID_PRODUCT = :id");
        $stmt->execute(['id' => $idProduto]);
        $produtoSelecionado = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar</title>
</head>
<body>
    <h2>Editar Produto ID: <?php echo htmlspecialchars($idProduto); ?></h2>

    <!-- Formulário que vai receber os dados do produto para edição -->
    <form action="salvar-edicao.php" method="POST">
        <!-- Input escondido para mandar o ID junto com o formulário -->
        <input type="hidden" name="id" value="<?php echo $produtoSelecionado['ID_PRODUCT'] ?? ''; ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $produtoSelecionado['NAME_PRODUCT'] ?? ''; ?>">

        <label>Preço:</label>
        <input type="text" name="preco" value="<?php echo $produtoSelecionado['PRICE_PRODUCT'] ?? ''; ?>">

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>