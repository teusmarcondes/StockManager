<?php
include_once 'conexao.php';

$id_fornecedor_produto = $_POST['id_fornecedor_produto'];
$escolha_produto = $_POST['escolha_produto'];
$escolha_fornecedor = $_POST['escolha_fornecedor'];
$categoria = $_POST['categoria'];

try {
    $sql = $pdo->prepare("UPDATE categorias SET id_produto = ?, id_fornecedor = ?, categoria = ? WHERE id_fornecedor_produto = ?");
    $sql->execute([$escolha_produto, $escolha_fornecedor, $categoria, $id_fornecedor_produto]);

    header('location:index.php?pagina=categorias');
} catch (Exception $e) {
    echo 'Não foi possível atualizar os registros: ' . $e->getMessage();
}
?>