<?php
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nivel'])){
    header('Location:login.php');
}else{
try{
    //recupera o nível de acesso armazenado na sessão
    $nivel_usuario= $_SESSION['nivel'];

    //permitir inserção de fornecedores para todos os usuários
    $permitir_inserir= true;

    //se o nível do usuário == admin, permita a edição e exclusão
    $permitir_editar_excluir= ($nivel_usuario == "admin");

    //consulta a tabela para inserção do fornecedor e recupera os registros
    $sql= $pdo->query("SELECT * FROM fornecedores");
    $resultados= $sql_fornecedores->fetchAll(PDO::FETCH_ASSOC);

    //se o formulário de inserção do fornecedor for submetido
    if(isset($_POST['nome_produto']) && isset($_POST['nome_fornecedor']) && isset($_POST['contato'])){
        //prepara a consulta para inserção de um novo fornecedor
        $sql_inserir_fornecedor= $pdo->query("INSERT INTO fornecedores (nome_produto, nome_fornecedor, contato) VALUES ('$escolha_produto', '$nome_fornecedor', '$contato')");
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
    <title>Fornecedores</title>
    <style>
        #menu a[href="?pagina=fornecedores"]{
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
                <h1>Fornecedores</h1>
            </div>
            <table style="border:1px solid #ccc; width:100%; text-align: center;" id="fornecedores">
                <?php if($permitir_inserir){?>
                    <div id="inserir">
                        <a href="?pagina=inserir_fornecedor">NOVO FORNECEDOR<i class="fa-solid fa-plus"></i></a>
                    </div>
                <?php } ?>
                <thead>
                <tr style="background-color: #ddd;">
                    <th style="text-align: center; border: 1px solid #000000;">Produto</th>
                    <th style="text-align: center; border: 1px solid #000000;">Nome do fornecedor</th>
                    <th style="text-align: center; border: 1px solid #000000;">Contato</th>
                    <?php if($permitir_editar_excluir) {?>
                        <th style="text-align: center; border: 1px solid #000000;">Editar</th>
                        <th style="text-align: center; border: 1px solid #000000;">Remover</th>
                    <?php } ?>
                </tr>
            </thead> 
            <tbody>  
                <?php
                    foreach($resultados as $linhas){ ?>
                        <tr style="background-color: white;"><td style="text-align: center; border: 1px solid #000000;"><?php 
                        echo $linhas['nome_produto']; ?></td>
                        <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['nome_fornecedor']; ?></td>
                        <td style="text-align: center; border: 1px solid #000000;"><?php echo $linhas['contato'];
                ?></td>
                <?php if($permitir_editar_excluir){?>
                    <!-- Editar registros -->
                    <td style="text-align: center; border: 1px solid #000000;">
                        <a href="?pagina=inserir_fornecedor&editar=<?php echo $linhas['id_fornecedor'];?>">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>

                    <!-- Excluir registros -->
                    <td style="text-align: center; border: 1px solid #000000;">
                        <a href="excluir_fornecedor.php?id_fornecedor=<?php echo $linhas['id_fornecedor'];?>" onclick="return confirm('Deseja excluir este registro?')">
                            <i class="fa-solid fa-trash-can" style="color: #ff4747;"></i>
                        </a>
                    </td>
                <?php }?>
                    </tr>
                <?php }?>
                </tbody>     
            </table>
        </div>
    </main>
</body>
</html>