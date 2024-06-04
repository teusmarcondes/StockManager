<?php
include_once 'conexao.php';
$id_fornecedor_produto= $_POST['id_fornecedor_produto'];
$escolha_produto= $_POST['escolha_produto'];
$escolha_fornecedor= $_POST['escolha_fornecedor'];
$categoria= $_POST['categoria'];

try{
    $sql = $pdo->query("UPDATE categorias SET id_produto = '$escolha_produto', id_fornecedor = '$escolha_fornecedor', categoria = '$categoria' WHERE id_fornecedor_produto = '$id_fornecedor_produto'");

    header('location:index.php?pagina=categorias');

}catch(Exception $e){
    echo 'Não foi possível atualizar os registros' .$e;
}

?>