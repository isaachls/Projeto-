<?php
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO CLIENTE (email, senha) VALUES (?, ?)";
$comando = $pdo->prepare($sql);
$comando->execute([$email, $senha]);

echo "Usuário cadastrado com sucesso! O banco de dados criou um ID para ele automaticamente.";
?>
