<?php

$server= "localhost";
$user= "root";
$password= "";
$database= "estoque";
$dns= "mysql:dbname=$database;host=$server";

date_default_timezone_set('America/Sao_Paulo');

try{
    $pdo= new PDO("$dns", "$user", "$password");

        #seleciona as tabelas
        $sql_produtos= $pdo->query("SELECT * FROM produtos");

        #para obter o nome dos produtos em que estão cadastrados(INNER JOIN)
        $sql_fornecedores = $pdo->query("SELECT fornecedores.id_produto, produtos.nome_produto, fornecedores.nome_fornecedor, fornecedores.contato
        FROM 
            produtos
        JOIN 
            fornecedores ON fornecedores.id_produto = produtos.id_produto");

        #para obter o nome dos produtos e o nome dos fornecedores em que estão cadastrados(INNER JOIN)
        $sql_categorias= $pdo->query("SELECT categorias.id_fornecedor_produto, fornecedores.id_produto, fornecedores.nome_produto,fornecedores.id_fornecedor, fornecedores.nome_fornecedor,categorias.categoria
        FROM 
            fornecedores
        JOIN 
            categorias");
}
catch(Exception $e){
    echo "Erro ao conectar " .$e;
}

?>