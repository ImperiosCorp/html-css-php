<?php
require('config\conexao.php')
//verificaçã se a postagem existe de acordo com os campos de preenchimento
if(isset($_POST['nome_completo']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['repete_senha'])){
    //verificar se todos os posts foram preenchidos
    if(empty($_POST['nome_completo']) or empty($_POST['email']) or empty($_POST['senha']) or empty($_POST['repete_senha']) or empty($_POST['termos']))
    &erro_geral = "todos os campos são obrigatorios"
}else{
    $nome = limparPost($_POST['nome_completo'])
    $email = limparPost($_POST['email'])
    $senha = limparPost($_POST['senha'])
    $senha_cript = sha1($senha);
    $repete_senha= limparPost($_POST['repete_senha'])
    $checkbox = limparPost($_POST['termos'])

    //verificar se nome é valido
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $erro_nome = "somente permitido letras e espaços em branco";
    }

    //validação de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro_email = "insira um email valido por favor";
    }
    //verificação de senha
    if(strlen($senha)< 8){
        $erro_senha = "a sua senha deve ter no minimo 8 digitos";
    }
    //verificação de repete senha
    if($senha !== $repete_senha){
        $repete_senha = "a senha deve ser igual a senha inserida anterior mente";
    }
    //verificação de marcação do checkbox
    if($checkbox!=="ok"){
        $erro_checkbox = "por favor ative o checkbox"
    }    

    if(!isset($erro_geral) && !isset($erro_nome) && !isset($erro_email) && !isset($erro_senha) && !isset($erro_repete_senha) && !isset($erro_checkbox)){
        //verificar se o usurario ja esta cadastrado no banco
        $sql = $pdo ->prepare("SELECT * FROM usuarios WHERE email=? LIMIT 1");
        $sql -> execute(array($email));
        $usuario = $sql -> fetch();

        //se não existe o usuario no banco de dados castreo
        if(!usuario){
            $recupera_senha="";
            $status="novo"
            $data_cadastro= date('d/m/Y')
            $sql = $pdo->prepare("INSERT INTO usuarios VALUES(null,?,?,?,?,?,?,?)");
            if($sql->execute(array($nome,$email,$senha_cript,$token,$status,$data_cadastro))){
                header('location: index.php?result=ok')
            }
        }
        //se ja existe o usuario
        else{
            $erro_geral = "usuario ja cadastrado"
        }
    }

      
      
}
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
            <h1>cadastro</h1>

            <?php if(isset($erro_geral)){ ?>
                <div class="erro-geral">
                   <?php echo  $erro_geral ?>
                </div>
            <?php}?>
            <div class="erro-geral">
                erro de cadastro
            </div>

            <div class="input-group">
                <img class="input-icon" src="img\pass (1).png">
                <input <?php if(isset($erro_geral) or isset($erro_nome)){echo 'class="erro-input"';}?> type="text" name="nome_completo"placeholder="Nome completo" require <?php if(isset($_POST[$nome_completo]){echo "value='".$_POST[$nome_completo]."'";})?>>
                <? if(isset($erro_nome)){?>
                <div class="erro"><?php $erro_nome;?></div>
                <?php }?>
            </div>

            <div class="input-group">
                <img class="input-icon" src="img\pass (1).png">
                <input <?php if(isset($erro_geral) or isset($erro_email)){echo 'class="erro-input"';}?> type="email" name="email" placeholder="digite seu E-mail" require <?php if(isset($_POST[$email]){echo "value='".$_POST[$email]."'";})?>>
                <? if(isset($erro_email)){?>
                <div class="erro"><?php $erro_email;?></div>
                <?php }?>
            </div>

            <div class="input-group">
                <img class="input-icon" src="img\web-browser.png">
                <input <?php if(isset($erro_geral) or isset($erro_senha)){echo 'class="erro-input"';}?> type="password" name="senha" placeholder="digite uma senha de no minimo 6 digitos" require <?php if(isset($_POST[$senha]){echo "value='".$_POST[$senha]."'";})?>>
                <? if(isset($erro_senha)){?>
                <div class="erro"><?php $erro_senha;?></div>
                <?php }?>
            </div>

            <div class="input-group">
                <img class="input-icon" src="img\unlock.png">
                <input <?php if(isset($erro_geral) or isset($erro_repete_senha)){echo 'class="erro-input"';}?> type="password" name="repete_senha"placeholder="digite a senha novamente" require <?php if(isset($_POST[$repete_senha]){echo "value='".$_POST[$repete_senha]."'";})?>>
                <? if(isset($erro_repete_senha)){?>
                <div class="erro"><?php $erro_repete_senha;?></div>
                <?php }?>
            </div>

            <div <?php if(isset($erro_geral) or isset($erro_checkbox)){echo 'class="input-group erro-input"';} else{echo 'class="input-group"'}?>>
                <input type="checkbox" id="termos" name="termos" value="ok" required>
                <label for="termos">Ao se cadastrar vc concorda com a nossa <a class="link" href="#">politica de privacidade </a>e os <a href="#">termos de uso</a></label>
                <? if(isset($erro_checkbox)){?>
                <div class="erro"><?php $erro_checkbox;?></div>
                <?php }?>
            </div>

            <button class="botão" type="submit">cadastrar</button>
            <a href="index.php">ja tenho cadastro</a>
        </form>
    </main>
    
</body>
</html>