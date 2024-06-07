<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
}
?>
<?php
require_once("conexao.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
    $codigo = $_POST['codigo'];
    $nome_produto = $_POST['nome_produto'];
    $entradas = $_POST['entradas'];
    $saidas = $_POST['saidas'];
    $saldos = $entradas - $saidas;

    try {
        $sql = $pdo->query("INSERT INTO produtos (data, codigo, nome_produto, entradas, saidas) VALUES ('$data', '$codigo', '$nome_produto', '$entradas', '$saidas')");

        echo "<script>window.alert('Dados registrados com sucesso')</script>";

        header('location:index.php?pagina=produtos');
    } catch (Exception $e) {
        echo "Erro ao cadastrar" . $e;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <style>
        h2 {
            color: white;
            text-align: center;
        }

        input {
            width: 100%;
            font-size: 15px;
            font-weight: bold;
            margin-top: 8px;
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

        .numero {
            width: 27%;
            float: left;
            margin: 10px;
        }

        .numerol {
            float: left;
            margin: 15px 0px 0px 0px;
        }
    </style>
</head>

<body>
    <?php if (!isset($_GET['editar'])) { ?>
        <form class="inserir" action="" method="post">
            <h2>Inserir novo produto</h2>
            <label for="">Data</label>
            <input type="date" name="data" required>
            <label for="">Código</label>
            <input type="text" name="codigo" required>
            <label for="">Nome do Produto</label>
            <input type="text" name="nome_produto" required>
            <label class="numerol" for="">Entradas</label>
            <input class="numero" type="text" min="1" name="entradas" required>
            <label class="numerol" for="">Saídas</label>
            <input class="numero" type="text" min="1" name="saidas" required>
            <button class="button" type="submit">Cadastrar</button>
        </form>
    <?php
    } else {
        $id_produto = $_GET['editar'];
        $sql_produtos = $pdo->query("SELECT * FROM produtos WHERE id_produto= $id_produto");
        $linhas = $sql_produtos->fetch(PDO::FETCH_ASSOC);
    ?>
        <form class="inserir" action="editar_produto.php" method="post">
            <h2>Editar produto</h2>
            <input type="hidden" name="id_produto" value="<?php echo $linhas['id_produto']; ?>">
            <label for="">Data</label>
            <input type="date" name="data" required value="<?php echo $linhas['data']; ?>">
            <label for="">Código</label>
            <input type="text" name="codigo" required value="<?php echo $linhas['codigo']; ?>">
            <label for="">Nome do Produto</label>
            <input type="text" name="nome_produto" required value="<?php echo $linhas['nome_produto']; ?>">
            <label class="numerol" for="">Entradas</label>
            <input class="numero" type="text" min="1" name="entradas" required value="<?php echo $linhas['entradas']; ?>">
            <label class="numerol" for="">Saídas</label>
            <input class="numero" type="text" min="1" name="saidas" required value="<?php echo $linhas['saidas']; ?>">
            <button class="button" type="submit">Atualizar produto</button>
        </form>
    <?php } ?>
</body>

</html>