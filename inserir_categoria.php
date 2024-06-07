<?php
require_once("conexao.php");

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $escolha_produto = $_POST['escolha_produto'];
    $escolha_fornecedor = $_POST['escolha_fornecedor'];
    $categoria = $_POST['categoria'];

    try {
        $sql = $pdo->prepare("INSERT INTO categorias (id_produto, id_fornecedor, categoria) VALUES (?, ?, ?)");
        $sql->execute([$escolha_produto, $escolha_fornecedor, $categoria]);

        echo "<script>window.alert('Dados registrados com sucesso');</script>";

        header('Location: index.php?pagina=categorias');
        exit;
    } catch (Exception $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}

// Consultas para recuperar os dados dos produtos e fornecedores
$sql_produtos = $pdo->query("SELECT id_produto, nome_produto FROM produtos");
$produtos = $sql_produtos->fetchAll(PDO::FETCH_ASSOC);

$sql_fornecedores = $pdo->query("SELECT id_fornecedor, nome_fornecedor FROM fornecedores");
$fornecedores = $sql_fornecedores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de categoria</title>
    <style>
        h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        input,
        select {
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

        label {
            display: block;
            color: white;
            font-weight: bold;
            margin: 5px 0 5px;
            font-size: 20px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php if (!isset($_GET['editar'])) { ?>
        <form class="inserir" action="" method="post">
            <h2>Inserir nova categoria</h2>
            <label for="escolha_produto">Produto</label>
            <select name="escolha_produto" required>
                <option value="" disabled selected>Selecione um produto</option>
                <?php
                foreach ($produtos as $produto) {
                    echo '<option value="' . $produto['id_produto'] . '">' . $produto['nome_produto'] . '</option>';
                }
                ?>
            </select>
            <label for="escolha_fornecedor">Nome do fornecedor</label>
            <select name="escolha_fornecedor" required>
                <option value="" disabled selected>Selecione um fornecedor</option>
                <?php
                foreach ($fornecedores as $fornecedor) {
                    echo '<option value="' . $fornecedor['id_fornecedor'] . '">' . $fornecedor['nome_fornecedor'] . '</option>';
                }
                ?>
            </select>
            <label for="categoria">Categoria</label>
            <input name="categoria" type="text" required>
            <button class="button" type="submit">Cadastrar</button>
        </form>
    <?php } else {
        $id_fornecedor_produto = $_GET['editar'];
        $sql_categorias = $pdo->prepare("SELECT produtos.nome_produto, fornecedores.nome_fornecedor, categorias.categoria 
                                FROM categorias 
                                JOIN produtos ON categorias.id_produto = produtos.id_produto 
                                JOIN fornecedores ON categorias.id_fornecedor = fornecedores.id_fornecedor 
                                WHERE categorias.id_fornecedor_produto = ?");
        $sql_categorias->execute([$id_fornecedor_produto]);
        $linha = $sql_categorias->fetch(PDO::FETCH_ASSOC);
    ?>
        <form class="inserir" action="editar_categoria.php" method="post">
    <h2>Editar categoria</h2>
    <input type="hidden" name="id_fornecedor_produto" value="<?php echo $id_fornecedor_produto; ?>">
    <label for="escolha_produto">Produto</label>
    <select name="escolha_produto" required>
        <?php
        foreach ($produtos as $produto) {
            $selected = ($produto['nome_produto'] == $linha['nome_produto']) ? 'selected' : '';
            echo '<option value="' . $produto['id_produto'] . '" ' . $selected . '>' . $produto['nome_produto'] . '</option>';
        }
        ?>
    </select>
    <label for="escolha_fornecedor">Nome do fornecedor</label>
    <select name="escolha_fornecedor" required>
        <?php
        foreach ($fornecedores as $fornecedor) {
            $selected = ($fornecedor['nome_fornecedor'] == $linha['nome_fornecedor']) ? 'selected' : '';
            echo '<option value="' . $fornecedor['id_fornecedor'] . '" ' . $selected . '>' . $fornecedor['nome_fornecedor'] . '</option>';
        }
        ?>
    </select>
    <label for="categoria">Categoria</label>
    <input name="categoria" type="text" value="<?php echo $linha['categoria']; ?>" required>
    <button class="button" type="submit">Atualizar</button>
</form>
    <?php } ?>
</body>
</html>