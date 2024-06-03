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
        $sql_fornecedores= $pdo->query("SELECT * FROM fornecedores");
        
        #para obter o nome dos produtos em que estão cadastrados(INNER JOIN)
        /* $sql_sfornecedores= $pdo->query("SELECT fornecedores.id_produto, produtos.nome_produto
        FROM produtos
        JOIN fornecedores ON fornecedores.id_produto = produtos.id_produto"); */ #recuperar o id do produto da tabela produtos para a tabela fornecedores

        #para obter o nome dos produtos e o nome dos fornecedores em que estão cadastrados(INNER JOIN)
        $sql_categorias= $pdo->query("SELECT categorias.id_fornecedor_produto, produtos.nome_produto, fornecedores.nome_fornecedor
        FROM produtos
        JOIN categorias ON categorias.id_produto = produtos.id_produto #recuperar o id do produto da tabela produtos para a tabela categorias
        JOIN fornecedores ON categorias.id_fornecedor = fornecedores.id_fornecedor");
}
catch(Exception $e){
    echo "Erro ao conectar " .$e;
}

?>