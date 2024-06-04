<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nivel'])){
    header('Location:login.php');
}else{
try{
    //recupera o nível de acesso armazenado na sessão
    $nivel_usuario= $_SESSION['nivel'];

    //permitir inserção de categorias para todos os usuários
    $permitir_inserir= true;

    //se o nível do usuário == admin permita a edição e exclusão
    $permitir_editar_excluir= ($nivel_usuario == "admin");

    //consulta a tabela para inserção da categoria e recupera os registros
    $sql= $pdo->query("SELECT * FROM categorias");
    $resultados= $sql_categorias->fetchAll(PDO::FETCH_ASSOC);

    //se o formulário de inserção da categoria for submetido
    if(isset($_POST['nome_produto']) && isset($_POST['nome_fornecedor'])){
        //prepara a consulta para inserção de uma nova categoria
        $sql_inserir_categoria= $pdo->query("INSERT INTO categorias (id_produto, id_fornecedor) VALUES ('$escolha_produto', '$escolha_fornecedor')");
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
    <title>Categorias</title>
    <style>
        #menu a[href="?pagina=categorias"]{
            color: rgb(255, 115, 0);
            font-weight: bold;
        }
        th{
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <main>
        <div id="logoc">
            <img src="img/logoc.png" title="Logo" alt="Logo">
            <h1>Categorias</h1>
        </div>
        <table style="border:1px solid #ccc; width:100%; text-align: center;" id="categorias">
            <?php if($permitir_inserir){?>
                <div id="inserir">
                    <a href="?pagina=inserir_categoria">CADASTRAR NOVA CATEGORIA<i class="fa-solid fa-plus"></i></a>
                </div>
            <?php } ?>
            <thead>
                <tr style="background-color: #ddd;">
                    <th style="text-align: center; border: 1px solid #000000;">Produto</th>
                    <th style="text-align: center; border: 1px solid #000000;">Nome do Fornecedor</th>
                    <th style="text-align: center; border: 1px solid #000000;">Categoria</th>
                    <?php if($permitir_editar_excluir) {?>
                        <th style="text-align: center; border: 1px solid #000000;">Editar</th>
                        <th style="text-align: center; border: 1px solid #000000;">Remover</th>
                    <?php } ?>
                </tr>
            </thead> 
            <tbody>  
                <?php
                    foreach($resultados as $linhas){ ?>
                        <tr style="background-color: white;"><td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['nome_produto']; ?></td>
                        <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['nome_fornecedor']; ?></td>
                        <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['categoria']; ?></td>
                    <?php if($permitir_editar_excluir){?>   
                        <!-- Editar registros -->
                        <td style="text-align: center; border: 1px solid #000000;"><a href="?pagina=inserir_categoria&editar=<?php echo $linhas['id_fornecedor_produto'];?>">
                        <i class="fa-solid fa-user-pen"></i>
                        </a></td>

                        <!-- Excluir registros -->
                        <td style="text-align: center; border: 1px solid #000000;"><a href="excluir_categoria.php?id_fornecedor_produto=<?php echo $linhas['id_fornecedor_produto'];?>" onclick="return confirm('Deseja excluir este registro?')">
                        <i class="fa-solid fa-trash-can" style="color: #ff4747;"></i>
                        </a></td>
                    <?php }?>
                        </tr>
                    <?php }?>
            </tbody>     
        </table>
    </main>
</body>
</html>