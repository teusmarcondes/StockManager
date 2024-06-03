<?php
require_once("conexao.php");
if(isset($_GET['id_fornecedor'])){
    $id_fornecedor= $_GET['id_fornecedor'];

    try{
        $sql= $pdo->query("DELETE FROM fornecedores WHERE id_fornecedor = '$id_fornecedor'");
        echo "<script>window.alert('Fornecedor excluído com sucesso')</script>";
        header('location:index.php?pagina=fornecedores');

    }catch(Exception $e){
        echo "Não foi possível excluir o registro" .$e;
    }
}

?>