<?php
if(isset($_SESSION['usuario'])){
    //armazenar o nome do usuário na variável
    $usuario_logado= $_SESSION['usuario'];
}else{
    //se não houver um usuário logado
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 1 - Configuração de media query -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        i[class="fa-solid fa-house fa-2xl"]{
            color: rgb(255, 115, 0);
        }
    </style>
</head>
<body>
    <h1 class="h1">Bem-vindo(a), <?php echo "$usuario_logado" ?> ao Sistema de Gestão de Estoque!</h1>
    <p class="p">Este sistema foi desenvolvido para facilitar a gestão de estoque em uma empresa ou logística. Com este sistema, você poderá gerenciar os produtos, facilitando o acompanhamento do estoque e administrativo da instituição.</p>
    <h2 class="h2">Recursos Principais:</h2>
    <ul>
        <li><strong>Cadastrar Produtos:</strong> Registre os dados dos produtos, incluindo data, descrição, e outras informações relevantes.</li>
        <li><strong>Excluir Produtos:</strong> Exclua produtos</li>
        <li><strong>Editar Produtos:</strong> Altere informações de produtos</li>
        <li><strong>Consultar o Saldo disponível:</strong> Realize a consulta de saldo dos produtos disponíveis</li>
    </ul>
</body>
</html>