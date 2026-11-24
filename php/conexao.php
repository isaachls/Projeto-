<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";          
$banco = "banco_bremster"; 
$dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Não foi possível conectar ao banco de dados.");
}
