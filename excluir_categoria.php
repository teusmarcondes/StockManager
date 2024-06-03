<?php
require_once("conexao.php");
if(isset($_GET['id_fornecedor_produto'])){
    $id_fornecedor_produto= $_GET['id_fornecedor_produto'];

    try{
        $sql= $pdo->query("DELETE FROM categorias WHERE id_fornecedor_produto = '$id_fornecedor_produto'");
        echo "<script>window.alert('Categoria excluída com sucesso')</script>";
        header('location:index.php?pagina=categorias');

    }catch(Exception $e){
        echo "Não foi possível excluir o registro" .$e;
    }
}

?>