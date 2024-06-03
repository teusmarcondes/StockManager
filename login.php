<!-- CDN da biblioteca SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/script.js"></script>
<!-- biblioteca Ajax para rodar a mensagem personalizada -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a84022c447.js" crossorigin="anonymous"></script>
<?php
if(isset($_POST['username']) && isset($_POST['password'])){
include_once "conexao.php";
$username= $_POST['username'];
$password= $_POST['password'];
$sql= $pdo->query("SELECT * FROM usuarios WHERE (usuario = '$username') and (senha = '$password') ");

//recupera as linhas da consulta
$result= $sql->fetchAll(PDO::FETCH_ASSOC);

//conta o numero total de registros
$total_registro= count($result);

if($total_registro > 0){
    //inicia a sessão para armazenar os dados do usuário
    session_start();
    //cria a sessão para receber o email ou cpf do usuário
    $_SESSION['usuario']= $result[0]['nome']; //recupera o nome do usuário
    $_SESSION['nivel']= $result[0]['nivel']; //recupera o nível de acesso do usuário
    echo "<script>window.location = 'index.php'</script>";
}else{
    echo "<script>
    $(function(){
    Mensagem('Dados incorretos!', '5000')
    })
    </script>";/* aqui definimos a mensagem da função e o tempo de execução */
}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- 1 - Configuração de media query -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
    a{
        color: #38b6ff;
        font-size: 26px;
        text-decoration: none;
        margin-top: 20px;
    }
    </style>
</head>
<body>
    <form class="form1" action="" method="post">
        <div class="img1">
            <img src="img/login.png" alt="Logo">
        </div>
            <div class="user">
                <div class="i2"> 
                    <i class="fa-solid fa-address-card"></i> 
                </div>    
                <input type="text" placeholder="Usuário" name="username" required>
            </div>
            <div class="senha">
                <div class="input"> 
                    <i class="fa-solid fa-lock"></i>
                </div>  
                <input type="password" placeholder="Senha" name="password" required>
            </div>  
        <a href="cadastro.php"><b><span>Não tem uma conta?</span> Registrar</b></a>
        <button class="button" type="submit">ENTRAR</button>
    </form>
</body>
</html>