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
    // Incluir arquivo de conexão com o banco de dados
    require 'conexao.php';  // Certifique-se de que o caminho está correto

    // Recupera o nível de acesso armazenado na sessão
    $nivel_usuario = $_SESSION['nivel'];

    // Permitir inserção de produtos para todos os usuários
    $permitir_inserir = true;

    // Se o nível do usuário é admin, permita a edição e exclusão
    $permitir_editar_excluir = ($nivel_usuario == "admin");
        // Consulta para selecionar todos os fornecedores
        $sql_fornecedores = $pdo->query("SELECT fornecedores.*, produtos.nome_produto
        FROM fornecedores
        JOIN produtos ON fornecedores.id_produto = produtos.id_produto");
        $resultados = $sql_fornecedores->fetchAll();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores</title>
    <style>
        #menu a[href="?pagina=fornecedores"] {
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
                <img src="img/logoc.png" alt="Logo">
                <h1>Fornecedores</h1>
            </div>
            <?php if ($permitir_inserir) { ?>
                <div id="inserir">
                    <a href="?pagina=inserir_fornecedor">NOVO FORNECEDOR<i class="fa-solid fa-plus"></i></a>
                </div>
            <?php } ?>
            <table style="border:1px solid #ccc; width:100%; text-align: center;" id="fornecedores" style="width:100%;">
                <thead>
                    <tr style="background-color: #ddd;">
                        <th style="text-align:center;">Produto</th>
                        <th style="text-align:center;">Nome</th>
                        <th style="text-align:center;">Contato</th>
                        <?php if ($permitir_editar_excluir) { ?>
                            <th style="text-align:center;">Editar</th>
                            <th style="text-align:center;">Remover</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $linha) { ?>
                        <tr style="background-color: white;">
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo isset($linha['nome_produto']) ? $linha['nome_produto'] : 'Produto não encontrado'; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linha['nome_fornecedor']; ?></td>
                            <td style="text-align: center;border: 1px solid #000000;"><?php echo $linha['contato']; ?></td>
                            <?php if ($permitir_editar_excluir) { ?>
                                <td style="text-align: center;border: 1px solid #000000;">
                                    <a href="?pagina=inserir_fornecedor&editar=<?php echo $linha['id_fornecedor']; ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;border: 1px solid #000000;">
                                    <a href="excluir_fornecedor.php?id_fornecedor=<?php echo $linha['id_fornecedor']; ?>" onclick="return confirm('Deseja excluir este registro?')">
                                        <i class="fa-solid fa-trash-can" style="color: #ff4747;"></i>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>