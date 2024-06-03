<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nivel'])){
    header('Location:login.php');
}else{
try{
    //recupera o nível de acesso armazenado na sessão
    $nivel_usuario= $_SESSION['nivel'];

    //permitir inserção de produtos para todos os usuários
    $permitir_inserir= true;

    //se o nível do usuário == admin, permita a edição e exclusão
    $permitir_editar_excluir= ($nivel_usuario == "admin");

    //consulta a tabela para inserção do produto e recupera os registros
    $sql= $pdo->query("SELECT * FROM produtos");
    $resultados= $sql_produtos->fetchAll(PDO::FETCH_ASSOC);

    //se o formulário de inserção do produto for submetido
    if(isset($_POST['data']) && isset($_POST['codigo']) && isset($_POST['nome_produto']) && isset($_POST['quantidade']) && isset($_POST['entradas']) && isset($_POST['saidas'])){
        //prepara a consulta para inserção de um novo produto
        $sql_inserir_produto= $pdo->query("INSERT INTO produtos (data, codigo, nome_produto, quantidade, entradas, saidas) VALUES ('$data', '$codigo', '$nome_produto', '$quantidade', '$entradas', '$saidas')");
    }
}catch(Exception $e){
    echo "Erro" .$e;
}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        #menu a[href="?pagina=produtos"]{
            color: rgb(255, 115, 0);
            font-weight: bold;
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
                <?php if($permitir_inserir){?>
                    <div id="inserir">
                        <a href="?pagina=inserir_produto">NOVO PRODUTO<i class="fa-solid fa-plus"></i></a>
                    </div>
                <?php } ?>
                <thead>
                    <tr style="background-color: #ddd;">
                        <th style="text-align: center; border: 1px solid #000000;">Data</th>
                        <th style="text-align: center; border: 1px solid #000000;">Código</th>
                        <th style="text-align: center; border: 1px solid #000000;">Nome do Produto</th>
                        <th style="text-align: center; border: 1px solid #000000;">Entradas</th>
                        <th style="text-align: center; border: 1px solid #000000;">Saídas</th>
                        <th style="text-align: center; border: 1px solid #000000;">Quantidade Estoque</th>
                        <?php if($permitir_editar_excluir) {?>
                            <th style="text-align: center; border: 1px solid #000000;">Editar</th>
                            <th style="text-align: center; border: 1px solid #000000;">Remover</th>
                        <?php } ?>
                    </tr>
                </thead> 
                <tbody>  
                    <?php
                        foreach($resultados as $linhas){ ?>
                            <tr style="background-color: white;"><td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['data']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['codigo']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['nome_produto']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['entradas']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['saidas']; ?></td>
                            <td style="text-align: center; border: 1px solid #000000;"><?php $saldo = $linhas['entradas'] - $linhas['saidas']; 
                            if($saldo == 0){
                                echo $saldo;
                            }
                            else if($saldo > 0){
                                echo "<p class='pg'>$saldo</p>";
                            }
                            else{
                                echo "<p class='pr'>$saldo</p>";
                            }
                    ?></td>
                    <?php if($permitir_editar_excluir){?>       
                        <!-- Editar registros -->
                        <td style="text-align: center; border: 1px solid #000000;"><a href="?pagina=inserir_produto&editar=<?php echo $linhas['id_produto'];?>">
                        <i class="fa-solid fa-user-pen"></i>
                        </a></td>
                        
                        <!-- Excluir registros -->
                        <td style="text-align: center; border: 1px solid #000000;"><a href="excluir_produto.php?id_produto=<?php echo $linhas['id_produto'];?>" onclick="return confirm('Deseja excluir este registro?')">
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