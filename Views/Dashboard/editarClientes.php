<?php
/** @var array $produto*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            border: 0;
            padding: 0;
            
        }

        body{
            display: flex;

        }
        
    </style>
</head>
<body>
    <div class="formEdit">
   <form method="POST"
      action="<?= BASE_URL ?>client/update/<?= $produto['ID_CLIENT'] ?>"
      enctype="multipart/form-data">
        <div class="formGroup">
            <label for="Nome">Nome:</label>
            <input type="text" name="NAME_CLIENT">
        </div>


         <div class="formGroup">
            <label for="Descrição">CPF:</label>
            <input type="text" name="CPF_CLIENT">
        </div>


         <div class="formGroup">
            <label for="Preço">TELEFONE</label>
            <input type="number" name="NUMBER_CLIENT">
        </div>




        <div class="formGroup">
            <label for="Foto">Foto</label>
            <input type="file" name="PHOTO_CLIENT" accept="image/* ">
        </div>

        <button type="submit" class="btn-submit">Salvar alterações</button>

         
</form>
</div>
</html>