<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="create-card">
        <div class="inside">
            <div class="create">Criar Produto</div>
            <form action="/Trabalho-4-bimestre-BD/product/create" method="POST" enctype="multipart/form-data">
             <div class="formGroup">
            <label for="Nome">Nome:</label>
            <input type="text" name="NAME_PRODUCT">
        </div>


         <div class="formGroup">
            <label for="Descrição">Descrição:</label>
            <input type="text" name="DESCRIPTION_PRODUCT">
        </div>


         <div class="formGroup">
            <label for="Preço">Preço:</label>
            <input type="number" name="PRICE_PRODUCT">
        </div>


         <div class="formGroup">
            <label for="Estoque">Quantidade em Estoque:</label>
            <input type="number" name="STOCK_PRODUCT">
        </div>


        <div class="formGroup">
            <label for="Foto">Foto</label>
            <input type="file" name="PHOTO_PRODUCT" accept="image/* " required>
        </div>

         <button type="submit" class="btn-submit">Salvar alterações</button>
            </form>

</body>
</html>