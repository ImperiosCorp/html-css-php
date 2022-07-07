<?php
$modo = 'local';

if($modo == 'local'){
    $servidor ="localhost";
    $usuario = "root";
    $senha = "";
    $banco = "login";
}
if($modo == 'producao'){
    $serivdor ="";
    $usuario ="";
    $senha = "";
    $banco = "";
}
try{
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "banco conectado";

}catch(PDOException $erro){
    //echo "falha ao se conectar com o banco!".$erro->getMessage;

}
function limpasPost($dados){
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}
?>