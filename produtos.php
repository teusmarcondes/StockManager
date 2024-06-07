<?php
// Verificar se a sessão não está ativa antes de iniciar
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nivel'])) {
    header('Location: login.php');
    exit;
}

try {
    // Conectar ao banco de dados
    require 'conexao.php';  // Certifique-se de que o caminho está correto

    // Recupera o nível de acesso armazenado na sessão
    $nivel_usuario = $_SESSION['nivel'];

    // Permitir inserção de produtos para todos os usuários
    $permitir_inserir = true;

    // Se o nível do usuário é admin, permita a edição e exclusão
    $permitir_editar_excluir = ($nivel_usuario == "admin");

    // Consulta a tabela produtos para recuperar os registros
    $sql = $pdo->query("SELECT * FROM produtos");
    $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Se o formulário de inserção do produto for submetido
    if (isset($_POST['data']) && isset($_POST['codigo']) && isset($_POST['nome_produto']) && isset($_POST['quantidade']) && isset($_POST['entradas']) && isset($_POST['saidas'])) {
        $data = $_POST['data'];
        $codigo = $_POST['codigo'];
        $nome_produto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $entradas = $_POST['entradas'];
        $saidas = $_POST['saidas'];

        // Prepara a consulta para inserção de um novo produto
        $sql_inserir_produto = $pdo->prepare("INSERT INTO produtos (data, codigo, nome_produto, quantidade, entradas, saidas) VALUES (?, ?, ?, ?, ?, ?)");
        $sql_inserir_produto->execute([$data, $codigo, $nome_produto, $quantidade, $entradas, $saidas]);

        // Redirecionar para a página de produtos após a inserção
        header('Location: produtos.php');
        exit;
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        #menu a[href="?pagina=produtos"] {
            color: rgb(255, 115, 0);
            font-weight: bold;
        }
        th, td {
            border: 1px solid #000;
            text-align: center;
        }
        th {
            border: 1px solid #000000;
            background-color: #ddd;
        }
        td{
            background-color: white;
        }
    </style>
</head>

<body>
    <main>
        <div class="main">
            <div id="logoc">
                <img src="img/logoc.png" title="Logoc" alt="Logoc">
                <h1>Produtos em estoque</h1>
            </div>
            <table style="border:1px solid #ccc; width:100%; text-align: center;" id="produtos">
                <?php if ($permitir_inserir) { ?>
                    <div id="inserir">
                        <a href="?pagina=inserir_produto">NOVO PRODUTO<i class="fa-solid fa-plus"></i></a>
                    </div>
                <?php } ?>
                <thead>
                    <tr style="background-color: #ddd;">
                        <th style="text-align:center;">Data</th>
                        <th style="text-align:center;">Código</th>
                        <th style="text-align:center;">Nome do Produto</th>
                        <th style="text-align:center;">Entradas</th>
                        <th style="text-align:center;">Saídas</th>
                        <th style="text-align:center;">Quantidade Estoque</th>
                        <?php if ($permitir_editar_excluir) { ?>
                            <th style="text-align:center;">Editar</th>
                            <th style="text-align:center;">Remover</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $linhas) { ?>
                        <tr style="background-color: white;">
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linhas['data']; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linhas['codigo']; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linhas['nome_produto']; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linhas['entradas']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['saidas']; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php $saldo = $linhas['entradas'] - $linhas['saidas'];
                            if ($saldo == 0) {
                                echo $saldo;
                            } else if ($saldo > 0) {
                                echo "<p class='pg'>$saldo</p>";
                            } else {
                                echo "<p class='pr'>$saldo</p>";
                            }
                            ?></td>
                            <?php if ($permitir_editar_excluir) { ?>
                                <!-- Editar registros -->
                                <td style="text-align: center;border: 1px solid #000000;"><a href="?pagina=inserir_produto&editar=<?php echo $linhas['id_produto']; ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a></td>

                                <!-- Excluir registros -->
                                <td style="text-align: center;border: 1px solid #000000;"><a href="excluir_produto.php?id_produto=<?php echo $linhas['id_produto']; ?>" onclick="return confirm('Deseja excluir este registro?')">
                                        <i class="fa-solid fa-trash-can" style="color: #ff4747;"></i>
                                    </a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>