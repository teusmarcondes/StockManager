<?php
require_once("conexao.php");
if(isset($_GET['id_produto'])){
    $id_produto= $_GET['id_produto'];

    try{
        $sql= $pdo->query("DELETE FROM produtos WHERE id_produto = '$id_produto'");
        echo "<script>window.alert('Produto excluído com sucesso')</script>";
        header('location:index.php?pagina=produtos');   

    }catch(Exception $e){
        echo "Não foi possível excluir o registro" .$e;
    }
}

?>