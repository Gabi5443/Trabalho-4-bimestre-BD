<?php
/** @var array $produto*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="formEdit">
   <form method="POST"
      action="<?= BASE_URL ?>product/update/<?= $produto['ID_PRODUCT'] ?>"
      enctype="multipart/form-data">
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
            <input type="file" name="PHOTO_PRODUCT" accept="image/* ">
        </div>

        <button type="submit" class="btn-submit">Salvar alterações</button>

         
</form>
</div>
</html>