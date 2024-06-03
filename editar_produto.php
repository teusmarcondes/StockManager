<?php
include_once 'conexao.php';
$id_produto= $_POST['id_produto'];
$data= $_POST['data'];
$codigo= $_POST['codigo'];
$nome_produto= $_POST['nome_produto'];
$entradas= $_POST['entradas'];
$saidas= $_POST['saidas'];

try{
    $sql = $pdo->query("UPDATE produtos SET data = '$data', codigo = '$codigo',nome_produto = '$nome_produto', entradas = '$entradas', saidas = '$saidas' WHERE id_produto = '$id_produto'");

    header('location:index.php?pagina=produtos');

}catch(Exception $e){
    echo 'Não foi possível atualizar os registros' .$e;
}

?>