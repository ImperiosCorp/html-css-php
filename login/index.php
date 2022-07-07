<?php
require('config/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>login</title>
</head>
<body>
    <main>
        <form>
            <h1>login</h1>

            <?php if (isset($_GET['result']) && ($_GET['result'])=="ok"){ ?>
                <div class="sucesso">
                cadastrado com sucesso!
            </div>
            <?php }?>
                
            <div class="input-group">
                <img class="input-icon" src="img\social-media.png">
                <input type="email" placeholder="digite seu Email">
            </div>

            <div class="input-group">
                <img class="input-icon" src="img\web-browser.png">
                <input type="senha" placeholder="digite sua senha">
            </div>

            <button class="botão" type="submit">login</button>
            <a href="cadastrar.php">ainda não sou cadastrado</a>
        </form>
    </main>
    
</body>
</html>