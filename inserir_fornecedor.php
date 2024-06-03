<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])){
    header('Location:login.php');
}
?>
<?php
require_once("conexao.php");
if (!isset($_GET['editar'])) {
    $sql_produtos = $pdo->query("SELECT * FROM produtos"); // Assuming your product table is named 'produtos'
    $resultados = $sql_produtos->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $escolha_produto= $_POST['escolha_produto'];
    $nome_fornecedor= $_POST['nome_fornecedor'];
    $contato= $_POST['contato'];

    try{
        $sql= $pdo->query("INSERT INTO fornecedores (id_produto, nome_fornecedor, contato) VALUES ('$escolha_produto', '$nome_fornecedor', '$contato')");

        echo "<script>window.alert('Dados registrados com sucesso')</script>";

        header('location:index.php?pagina=fornecedores');

    }catch(Exception $e){
        echo "Erro ao cadastrar" .$e;
    }
}
}
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
                <option value="produto" disabled>Selecione um produto</option>
                <?php 
                #recuperar o nome do produto da tabela produtos
                $resultados= $sql_produtos->fetchAll(PDO::FETCH_ASSOC);
                foreach($resultados as $linhas){
                    echo '<option value=" '.$linhas['id_produto'].' ">'.$linhas['nome_produto']. '</option>';
                }
                ?>
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
        <form class="inserir" action="editar_fornecedor.php" method="post">
            <h2>Editar fornecedor</h2>
            <input type="hidden" name="id_fornecedor" value="<?php echo $linhas['id_fornecedor']; ?>">
            <label for="">Produto</label>
            <select name="nome_produto"> 
                <option value="produto" disabled>Selecione um produto</option>
                <?php 
                $resultados = $sql_produtos;
                foreach($resultados as $linhas){
                    echo '<option value=" '.$linhas['id_produto'].' ">'.$linhas['nome_produto']. '</option>';
                }
                ?>
            </select>
            <label for="">Nome do fornecedor</label>
            <input type="text" name="nome_fornecedor" required value="<?php echo $linhas['nome_fornecedor']; ?>">
            <label for="">Contato</label>
            <input type="text" name="contato" required value="<?php echo $linhas['contato']; ?>">
            <button class="button" type="submit">Atualizar fornecedor</button>
        </form>
    <?php } ?>
</body>
</html>