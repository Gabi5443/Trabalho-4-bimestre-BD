<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <aside class="sidebar">
        <a href="index.php?pagina=main">Home</a>
        <a href="index.php?pagina=cardapio">Cardápio</a>
        <a href="index.php?pagina=usuarios">Usuários</a>
    </aside>
    <main>
        <?php
            $pagina = $_GET['pagina'] ?? 'main';

            switch ($pagina) {
                case 'main':
                    include 'Views/Dashboard/main.php';
                    break;

                case 'cardapio': 
                    include 'Views/Dashboard/cardapio.php';
                    break;

                case 'editar-produto':
                    include 'Views/Dashboard/editar-produto.php';
                    break;
                
                case 'usuarios':
                    include 'Views/Dashboard/usuarios.php';
                    break;
                
                default:
                    echo "página não encontrada";
                    break;
            }
        ?>
    </main>
</body>
</html>