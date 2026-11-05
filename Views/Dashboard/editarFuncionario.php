<?php
/** @var array $worker*/
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
      action="<?= BASE_URL ?>worker/update/<?= $worker['ID_WORKER'] ?>"
      enctype="multipart/form-data">
        <div class="formGroup">
            <label for="Nome">Nome:</label>
            <input type="text" name="NAME_WORKER">
        </div>


         <div class="formGroup">
            <label for="Descrição">CARGO:</label>
            <input type="text" name="ROLE_WORKER">
        </div>


         <div class="formGroup">
            <label for="Preço">REGISTRO</label>
            <input type="number" name="REGISTRATION_WORKER">
        </div>




        <div class="formGroup">
            <label for="Foto">Foto</label>
            <input type="file" name="PHOTO_WORKER" accept="image/* ">
        </div>

        <button type="submit" class="btn-submit">Salvar alterações</button>

         
</form>
</div>
</html>