<!-- Incluir bibliotecas externas -->
<!-- CDN da biblioteca SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/script.js"></script>
<!-- biblioteca Ajax para rodar a mensagem personalizada -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a84022c447.js" crossorigin="anonymous"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    include_once "conexao.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Usar prepared statements para evitar SQL injection
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
        $stmt->execute([$username, $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se há registros correspondentes
        if ($result) {
            session_start();
            // Armazenar dados do usuário na sessão
            $_SESSION['usuario'] = $result['nome'];
            $_SESSION['nivel'] = $result['nivel'];

            echo "<script>window.location = 'index.php'</script>";
        } else {
            echo "<script>
        $(function(){
        Mensagem('Senhas não coincidem!', '2000')
        })
        </script>";
        }
    } catch (Exception $e) {
        echo "Erro ao verificar o usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
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
        <a class="registrar" href="cadastro.php"><b><span>Não tem uma conta?</span> Registrar</b></a>
        <button class="button" type="submit">ENTRAR</button>
    </form>
</body>
</html>