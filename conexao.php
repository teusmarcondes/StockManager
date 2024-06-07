<?php
// Configurações de conexão com o banco de dados
$server = "localhost";
$user = "root";
$password = "";
$database = "estoque";
$dsn = "mysql:dbname=$database;host=$server";

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    // Tratamento de erro
    echo "Erro ao conectar: " . $e->getMessage();
}
?>