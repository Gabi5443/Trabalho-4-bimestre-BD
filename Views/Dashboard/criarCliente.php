<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <form action="/Trabalho-4-bimestre-BD/client/create" method="POST" enctype="multipart/form-data">
     <label for="Nome">Nome:</label>
            <input type="text" name="NAME_CLIENT">
        </div>


         <div class="formGroup">
            <label for="Descrição">CPF:</label>
            <input type="text" name="CPF_CLIENT">
        </div>


         <div class="formGroup">
            <label for="Preço">Telefone:</label>
            <input type="number" name="NUMBER_CLIENT">
        </div>



        <div class="formGroup">
            <label for="Foto">Foto</label>
            <input type="file" name="PHOTO_CLIENT" accept="image/* " required>
        </div>

         <button type="submit" class="btn-submit">Salvar alterações</button>
            </form>

</body>
</html>