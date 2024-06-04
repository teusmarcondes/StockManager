<?php
include_once 'conexao.php';
$id_fornecedor= $_POST['id_fornecedor'];
$escolha_produto= $_POST['escolha_produto'];
$nome_fornecedor= $_POST['nome_fornecedor'];
$contato= $_POST['contato'];

try{
    $sql = $pdo->query("UPDATE fornecedores SET nome_produto = '$escolha_produto', nome_fornecedor = '$nome_fornecedor', contato = '$contato' WHERE id_fornecedor = '$id_fornecedor'");

    header('location:index.php?pagina=fornecedores');

}catch(Exception $e){
    echo 'Não foi possível atualizar os registros' .$e;
}

?>