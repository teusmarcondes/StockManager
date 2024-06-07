<?php
// Verificar se a sessão não está ativa antes de iniciar
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (isset($_SESSION['usuario'])) {
    
    // Incluir arquivos necessários
    include 'conexao.php';
    include 'header.php';

    // Verificar se existe a variável $_GET['pagina']
    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];

        // Selecionar o conteúdo com base na página solicitada
        switch ($pagina) {
            case 'produtos':
                include 'produtos.php';
                break;
            case 'fornecedores':
                include 'fornecedores.php';
                break;
            case 'categorias':
                include 'categorias.php';
                break;
            case 'inserir_produto':
                include 'inserir_produto.php';
                break;
            case 'inserir_fornecedor':
                include 'inserir_fornecedor.php';
                break;
            case 'inserir_categoria':
                include 'inserir_categoria.php';
                break;
            default:
                // Página não encontrada ou inválida
                include '404.php';
                break;
        }
    } else {
        // Incluir a página principal se nenhuma página específica for solicitada
        include 'home.php';
    }

    // Incluir o rodapé
    include 'footer.php';

} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header('Location: login.php');
    exit();
}
?>