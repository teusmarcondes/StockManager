<?php
require_once "conexao.php"; // Inclua o arquivo de conexão

// Recuperar os produtos da tabela produtos
$sql_produtos = $pdo->query("SELECT * FROM produtos");
$resultados = $sql_produtos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de fornecedor</title>
    <style>
    h2{
        color: white;
        text-align: center;
        margin-bottom: 30px;
    }
    input, select{
        width: 100%;
        padding: 8px;
        font-size: 15px;
        font-weight: bold;
        box-sizing: border-box;
        border: 1px solid #ccc;
        margin-top: 8px;
        background-color: white;
        color: black;
    }
    label{
        display: block;
        color: white;
        font-weight: bold;
        margin: 5px 0 5px;
        font-size: 20px;
    }
    button:hover{
        background-color: #45a049;
    }    
     </style>
</head>
<body>
<?php if(!isset($_GET['editar'])){?>
    <form class="inserir" action="" method="post">
        <h2>Inserir novo fornecedor</h2>
        <label for="">Produto</label>
        <select name="escolha_produto">
            <option value="produto" disabled selected>Selecione um produto</option>
            <?php foreach ($resultados as $linhas) : ?>
                <option value="<?php echo $linhas['id_produto']; ?>"><?php echo $linhas['nome_produto']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="">Nome Fornecedor</label>
        <input type="text" name="nome_fornecedor" required>
        <label for="">Contato</label>
        <input type="text" name="contato" required>
        <button class="button" type="submit">Cadastrar</button>
    </form>
    <?php 
    }else {
        $id_fornecedor= $_GET['editar'];
        $sql_fornecedores= $pdo->query("SELECT * FROM fornecedores WHERE id_fornecedor= $id_fornecedor");
        $linhas= $sql_fornecedores->fetch(PDO::FETCH_ASSOC);
    ?>
            <form class="inserir" action="" method="post">
        <h2>Inserir novo fornecedor</h2>
        <label for="">Produto</label>
        <select name="escolha_produto">
            <option value="produto" disabled selected>Selecione um produto</option>
            <?php foreach ($resultados as $linhas) : ?>
                <option value="<?php echo $linhas['id_produto']; ?>"><?php echo $linhas['nome_produto']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="">Nome Fornecedor</label>
        <input type="text" name="nome_fornecedor" required>
        <label for="">Contato</label>
        <input type="text" name="contato" required>
        <button class="button" type="submit">Cadastrar</button>
        </form>
    <?php } ?>
</body>
</html>