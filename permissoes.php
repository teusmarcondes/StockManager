<?php
session_start();

// Definição das permissões padrão
$permitir_inserir = true;
$permitir_editar_excluir = false;

// Verificar o nível de acesso do usuário apenas se estiver logado
if (isset($_SESSION['nivel'])) {
    $nivel_usuario = $_SESSION['nivel'];
    $permitir_editar_excluir = ($nivel_usuario === "admin");
}

try {
    // Consulta para selecionar todos os produtos
    $sql_produtos = $pdo->query("SELECT * FROM produtos");

    // Consulta para obter produtos e seus fornecedores usando INNER JOIN
    $sql_fornecedores_produtos = $pdo->query("
        SELECT produtos.id_produto, produtos.nome_produto, fornecedores.nome_fornecedor
        FROM produtos 
        INNER JOIN fornecedores ON produtos.id_produto = fornecedores.id_produto
    ");

    // Consulta para selecionar categorias, produtos e fornecedores
    $sql_categorias = $pdo->query("
        SELECT categorias.*, produtos.nome_produto, fornecedores.nome_fornecedor 
        FROM categorias 
        JOIN produtos ON categorias.id_produto = produtos.id_produto 
        JOIN fornecedores ON categorias.id_fornecedor = fornecedores.id_fornecedor
    ");
    $resultados = $sql_categorias->fetchAll();
} catch (PDOException $e) {
    // Tratamento de erro
    echo "Erro: " . $e->getMessage();
}
?>