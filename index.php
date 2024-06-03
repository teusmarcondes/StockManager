<?php
//iniciar a sessão
session_start();

if(isset($_SESSION['usuario'])){

// Incluir arquivos necessários
include 'conexao.php';
include 'header.php';

// Verificar se existe a variável $_GET['pagina']
if(isset($_GET['pagina'])){
    $pagina= $_GET['pagina'];

    //conteúdo
    if($pagina == 'produtos'){
        include 'produtos.php';
    }
    else if($pagina == 'fornecedores'){
        include 'fornecedores.php';
    }
    else if($pagina == 'categorias'){
        include 'categorias.php';
    }
    else if($pagina == 'inserir_produto'){
        include 'inserir_produto.php';
    }
    else if($pagina == 'inserir_fornecedor'){
        include 'inserir_fornecedor.php';
    }
    else if($pagina == 'inserir_categoria'){
        include 'inserir_categoria.php';
    }
}  
// se existir a variável $_GET['pagina'] inclua a pagina principal  
    else{
        include 'home.php';
    }
    
//rodapé
include 'footer.php';

}else{
    header('location:login.php');
}
?>